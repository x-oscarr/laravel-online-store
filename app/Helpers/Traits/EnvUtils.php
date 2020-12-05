<?php


namespace App\Helpers\Traits;


trait EnvUtils
{
    static public function updateDotEnv($key, $newValue, $delim = '')
    {
        $path = base_path('.env');

        $oldValue = env($key);
        if ($oldValue === $newValue) {
            return;
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key.'='.$delim.$oldValue.$delim,
                $key.'='.$delim.$newValue.$delim,
                file_get_contents($path)
            ));
        }
    }
}
