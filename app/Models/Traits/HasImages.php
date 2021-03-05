<?php

namespace App\Models\Traits;

use App\Models\FileModel;
use Illuminate\Support\Facades\Storage;

trait HasImages
{
    protected function getDefaultFIle(): string
    {
        if($this->type && config("filesystems.types.$this->type.default_file")) {
            return Storage::url(config("filesystems.types.$this->type.default_file"));
        }
        return Storage::url(config('filesystems.default_files.image'));
    }

    # Mutators
    public function getPrimaryImageUrlAttribute(): string
    {
        return $this->images->first()->fileUrl ?? $this->getDefaultFile();
    }
}
