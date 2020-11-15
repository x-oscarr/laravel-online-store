<?php


namespace App\Helpers\Traits;

use Exception;
use App\Models\File;

trait FileUtils
{
    static public function getMimeTypes($typeGroup)
    {
        switch ($typeGroup) {
            case File::MIME_TYPES_IMAGE: return config('filesystems.mime_types.image');
            case File::MIME_TYPES_VIDEO: return config('filesystems.mime_types.video');
            case File::MIME_TYPES_AUDIO: return config('filesystems.mime_types.audio');
            case File::MIME_TYPES_ARCHIVE: return config('filesystems.mime_types.archive');
            case File::MIME_TYPES_DOCUMENT: return config('filesystems.mime_types.document');
            case File::MIME_TYPES_PDF: return config('filesystems.mime_types.pdf');
            default:
                $mimeTypes = config("filesystems.mime_types.$typeGroup");
                if(!$mimeTypes) {
                    $modelNamespace = File::class;
                    throw new Exception("Mime type group $typeGroup is not found. You can check all type groups in the '$modelNamespace' or config 'filesystems.php'");
                }
                return $mimeTypes;
        }
    }
}
