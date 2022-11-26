<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MediaOperator
{
    public function uploadFile($file, $path = 'uploads/')
    {

        $file_name = $path.'_'.time().'_'.rand(50000, 9999).'.'.$file->getClientOriginalExtension();

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

    public function multiFileUpload($urls, $model, $type = 'image')
    {
        foreach ($urls as $url) {
            $model->images()->create([
                'url' => $url,
                'image' => $type,
            ]);
        }
    }

    public function singleFileUpload($url, $model, $type = 'profile')
    {
        $model->image()->create([
            'url' => $url,
            'type' => $type,
        ]);
    }

    public function multiFileDelete($images)
    {
        foreach ($images as $image) {
            $this->deleteFile($image->url);
        }
    }

    public function validationCheck ($image) {

        $allowedfileExtension=['jpg','png', 'jpeg'];
        $extension = $image->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);

        if ($check) return true;
        return false;
    }
}
