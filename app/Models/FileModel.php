<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use RuntimeException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class FileModel extends Model
{
    use HasFactory;
    use HasImages;

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

    public function fileInStorage(): Relation
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    # Mutators
    public function getFileUrlAttribute()
    {
        if ($this->url) {
            return $this->url;
        }

        if ($this->fileInStorage) {
            return $this->fileInStorage->fileUrl;
        }

        $this->getDefaultFile();
    }

    public function setFileAttribute($file): void
    {
        if ($file instanceof \SplFileInfo) {
            $this->uploadedFile = $file;
        } elseif (strpos($file, 'http') !== false) {
            $attributes['url'] = $file;
        } else {
            throw new RuntimeException('Attribute "file" not identified');
        }
    }

}
