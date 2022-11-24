<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MediaOperator
{
    public function uploadFile($file, $path = 'uploads/')
    {
        $file_name = $path.'_'.time().'_'.rand(50000).'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($file_name, file_get_contents($file));

        return $file_name;
    }

    public function deleteFile($file_name)
    {
        Storage::disk('public')->delete($file_name);
    }

    public function getFile($file_name)
    {
        return Storage::disk('public')->get($file_name);
    }

    public function getFileUrl($file_name)
    {
        return Storage::disk('public')->url($file_name);
    }

    public function multiFileUpload($urls, $model)
    {
    }
}
