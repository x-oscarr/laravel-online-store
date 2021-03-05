<?php

namespace App\Observers;

use App\Models\File;
use App\Models\FileModel;

class FileModelObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function created(FileModel $fileModel)
    {
        if ($fileModel->uploadedFile) {
            $file = File::store($fileModel->uploadedFile, $fileModel->type);
            $fileModel->file_id = $file->id;
            $fileModel->save();
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function updated(FileModel $fileModel)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function deleted(FileModel $fileModel)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function restored(FileModel $fileModel)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function forceDeleted(FileModel $fileModel)
    {
        //
    }
}
