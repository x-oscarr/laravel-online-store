<?php


namespace App\Services\Allegro;


use GuzzleHttp\Client;

class AllegroApi
{
    const AUTH_URL = 'https://allegro.pl';
    const API_URL = 'https://api.allegro.pl';
    const H_ACCEPT = 'application/vnd.allegro.public.v1+json';
    const FAST_VERIFICATION_PATH = '/auth/oauth/headless/authorize';
    const AVAILABLE_HTTP_METHODS = ['get', 'post', 'put', 'delete'];

    protected $tokens;

    public function __construct($tokens = null)
    {
        $this->tokens = $tokens;
    }

    public function __call($name, $arg)
    {
        if(in_array($name, self::AVAILABLE_HTTP_METHODS)) {
            return $this->apiRequest(strtoupper($name), $arg[0], $arg[1] ?? []);
        }
    }

    // Auth
    private static function authClient(string $path, array $params)
    {
        $client = new Client();
        $res = $client->request('POST', self::AUTH_URL.$path, [
            'auth' => [
                config('allegro.client_id'),
                config('allegro.client_secret')
            ],
            'form_params' => $params
        ]);
        if($res->getStatusCode() != 200) {
            return false;
        }
        return json_decode($res->getBody()->getContents());
    }

    public static function registerDevice($clientId = null, $redirectUri = null)
    {
        $data = self::authClient('/auth/oauth/device', [
            'client_id' => $clientId ?? config('allegro.client_id'),
            'redirect_uri' => $redirectUri
        ]);
        $data->verification = self::AUTH_URL.self::FAST_VERIFICATION_PATH.'?'.http_build_query([
                'user_code' => $data->user_code,
                'prompt' => 'confirm'
            ]);
        return $data;
    }

    public function registerToken(string $deviceCode)
    {
        $this->tokens = self::authClient('/auth/oauth/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:device_code',
            'device_code' => $deviceCode
        ]);
        return $this->tokens;
    }

    protected function refreshToken()
    {
        $this->tokens = self::authClient('/auth/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->tokens->refreshToken
        ]);
    }

    //

    private function apiRequest(string $method, string $path, array $params) {
        $client = new Client();
        $res = $client->request($method, self::API_URL.$path, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->tokens->access_token,
                'Accept' => self::H_ACCEPT
            ],
            'form_params' => $params
        ]);
        if($res->getStatusCode() != 200) {
            return false;
        }

        return json_decode($res->getBody()->getContents());
    }
}
