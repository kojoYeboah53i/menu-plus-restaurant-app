<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadTrait
{
    public function uploadOne($image, $folder, $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        $path = config('filesystems.disks.s3.url'). '/' . $image->storePubliclyAs($folder, $name, 's3');
        return $path;
    }

    public function deleteOne($file)
    {
        return Storage::disk('s3')->delete($file);
    }
}
