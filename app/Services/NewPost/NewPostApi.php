<?php


namespace App\Services\NewPost;


use GuzzleHttp\Client;

class NewPostApi
{
    const API_URL = 'https://api.novaposhta.ua/v2.0/json';
    const AVAILABLE_HTTP_METHODS = ['post'];

    private $apiKey;

    public function __construct($apiKey)
    {
        return $this->apiKey = $apiKey;
    }

    public function __call($name, $arg)
    {
        if(in_array($name, self::AVAILABLE_HTTP_METHODS)) {
            return $this->apiRequest(strtoupper($name), $arg[0], $arg[1] ?? []);
        }
    }

    private function apiRequest(string $method, array $params) {
        $client = new Client();
        $params = array_merge(['apiKey' => $this->apiKey], $params);
        $res = $client->request($method, self::API_URL, [
            'body' => json_encode($params)
        ]);
        if($res->getStatusCode() != 200) {
            return false;
        }
        return json_decode($res->getBody()->getContents());
    }
}
