<?php

namespace App\Models;

use App\Scopes\IsNotDeletedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class File extends Model
{
    use HasFactory;

    const TYPE_FIRST_IMAGE = 'first_image';
    const TYPE_IMAGE = 'image';
    const TYPE_DESCRIPTION_IMAGE = 'description_image';

    const TYPE_DOCUMENT = 'document';

    const MIME_TYPES_IMAGE = 'image';
    const MIME_TYPES_VIDEO = 'video';
    const MIME_TYPES_AUDIO = 'audio';
    const MIME_TYPES_ARCHIVE = 'archive';
    const MIME_TYPES_DOCUMENT = 'document';
    const MIME_TYPES_PDF = 'pdf';

    const TYPES = [
        self::MIME_TYPES_IMAGE => 'model.files.type.image',
        self::MIME_TYPES_IDEO => 'model.files.type.video',
        self::MIME_TYPES_AUDIO => 'model.files.type.audio',
        self::MIME_TYPES_ARCHIVE => 'model.files.type.archive',
        self::MIME_TYPES_DOCUMENT => 'model.files.type.document',
        self::MIME_TYPES_PDF => 'model.files.type.pdf',
    ];

    protected $fillable = ['model', 'model_id', 'original_name', 'name', 'type'];

    protected static function booted()
    {
        static::addGlobalScope(new IsNotDeletedScope());
    }

    # Relationships
    public function model()
    {
        return $this->belongsTo($this->model, 'model_id');
    }

    #Mutatots
    public function setUrlAttribute($value)
    {
        $baseUrl = URL::to('/');
        if(!Str::contains($value, 'http://'.$baseUrl) && !Str::contains($value, 'https://'.$baseUrl)) {
            return $this->attributes['url'] = $value;
        }

        $url = explode('/', $value);
        return $this->attributes['file'] = $url[array_key_last($url)];
    }

    static public function store($file, Model $model, string $type)
    {
        if($file instanceof UploadedFile) {
            self::storeUploadedFileByModel($file, $model, $type);
        } else {
            self::storeUrlFileByModel($file, $model, $type);
        }
    }

    static public function storeUploadedFileByModel(UploadedFile $uploadedFile, Model $model, string $type)
    {
        $originalName = $uploadedFile->getClientOriginalName();
        $microtime = microtime();
        $name = Str::snake("$originalName $microtime");

        $file = new File();
        $file->model = get_class($model);
        $file->model_id = $model->id;

        $file->original_name = $originalName;
        $file->name = $name;
        $file->url = $originalName;

        $file->mime_type = $uploadedFile->getClientMimeType();
        $file->size = $uploadedFile->getSize();

        $uploadedFile->storeAs('dg', $name, $disc);
    }

    static public function storeUrlFileByModel(string $urlFile, Model $model) {
        $file = new File();
        $file->model = get_class($model);
        $file->model_id = $model->id;

        $file->original_name = $originalName;
        $file->name = $name;
        $file->url = $originalName;

        $file->mime_type = $uploadedFile->getClientMimeType();
        $file->size = $uploadedFile->getSize();
    }
}
