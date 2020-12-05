<?php


namespace App\Helpers;

use App\DataHolder\FileParamsLoaderHolder;
use App\Models\FileModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class Template
{
    static function name(): string
    {
        return config('app_template.template');
    }

    static function config(string $key = '')
    {
        $name = self::name();
        return config("app_template.configuration.$name.$key");
    }

    static function factoryFilesLoader(Model $model)
    {
        $path = self::config('storage.path');
        if(!File::isDirectory($path)) {
            return;
        }

        $folders = File::directories($path);
        $classConfig = self::config('storage.class.'.get_class($model));
        foreach ($folders as $folder) {
            $type = Utils::getFileNameFromPath($folder);
            $files = File::allFiles($folder);
            $quantity = $classConfig[$type] ?? false;
            if ($quantity === false || !Utils::getFileTypeConfig($type)) {
                continue;
            } elseif (is_array($quantity)) {
                [$min, $max] = $quantity;
                $fileKeys = (array)array_rand($files, rand($min, $max));
                $files = array_intersect_key($files, array_flip($fileKeys));
            } elseif ($quantity) {
                $files = [$files[array_rand($files, $quantity)]];
            }

            foreach ($files as $file) {
                $model->images()->create([
                    'file' => $file,
                    'type' => $type
                ]);
            }
        }
        $model->save();
    }

    static public function seederLoader(Seeder $seeder)
    {
        $namespace = self::config('seeder.namespace');
        $path = self::config('seeder.path');

        if(File::isDirectory($path)) {
            foreach (File::allFiles($path) as $file) {
                [$class, $ext] = explode('.', $file->getFilename());

                if($ext === 'php') {
                    $class = "$namespace\\$class";
                    $seeder->call($class);
                }
            }
        }

        return $seeder;
    }
}
