<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileModel extends Model
{
    use HasFactory;

    const TYPE_PRODUCT_IMAGE = 'product_image';
    const TYPE_CATEGORY_IMAGE = 'category_image';

    public $uploadedFile;
    protected $fillable = ['file', 'type', 'model'];

    public function __construct(array $attributes = [])
    {
        if(isset($attributes['file']) && $attributes['file']) {
            $this->setFileAttribute($attributes['file']);
            unset($attributes['file']);
        }
        if(isset($attributes['model']) && $attributes['model'] instanceof Model) {
            $this->model = $attributes['model'];
        }

        parent::__construct($attributes);
    }

    # Relationships
    public function model()
    {
        return $this->morphTo('model');
    }

    public function fileInStorage()
    {
        return $this->hasOne(File::class);
    }

    # Mutators

    public function getFileAttribute()
    {
        if($this->url) {
            return $this->url;
        } elseif($this->fileInStorage) {
            return Storage::url($this->fileInStorage->original_name);
        } else {
            if($this->type && config("filesystems.types.$this->type.default_file")) {
                return config("filesystems.types.$this->type.default_file");
            }
            return config('filesystems.default_files.image');
        }
    }

    public function setFileAttribute($file) {
        if ($file instanceof \SplFileInfo) {
            $this->uploadedFile = $file;
        } elseif (strpos($file, 'http') !== false) {
            $attributes['url'] = $file;
        } else {
            throw new \Exception('Attribute "file" not identified');
        }
    }

}
