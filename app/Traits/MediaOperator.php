<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

trait MediaOperator
{
    protected $path = "uploads/";

    public function uploadFile($file)
    {

        $file_name = $this->path.rand(10000000, 9999999999).'_'.time().'_'.rand(50000, 9999).'.'.$file->getClientOriginalExtension();

        Storage::disk('public')->put($file_name, file_get_contents($file));

        return $file_name;
    }

    public function deleteFile($file_name)
    {
        return Storage::disk("public")->delete($file_name);
    }

    public function getFile($file_name)
    {
        return Storage::disk('public')->get($file_name);
    }

    public function getFileUrl($file_name)
    {
        return Storage::disk('public')->url($file_name);
    }

    public function getModel (string $type, int $id) {
        $model = null;
        switch ($type) {
            case 'reward':
                $model = \App\Models\Reward::query();
                break;
            case 'slider':
                $model = \App\Models\Slider::query();
                break;
            case 'profile':
                $model = \App\Models\User::query();
                break;
            default:
                $model = \App\Models\Product::query();
                break;
        }

        return $model->where('id', $id)->first();
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

    public function imageUploadDatabase ($is_multiple, $model, $array) {

        if ($is_multiple) {
            $model->images()->create($array);
        }else{
            $model->image()->create($array);
        }
    }

    public function imageFullyDelete ($is_multiple, $model, $type, $id = null) {

        if (in_array($type, ['reward', 'gellary'])) return true;

        $model = $is_multiple ? $model->images : $model->image;

        $image = $model->where('id', $id)->first();

        if (!$image) {
            $image = $model->where('type', $type)->first();
        }

        // delete from storage
        $this->deleteFile($image->url);

        // delete row from data
        return $image->delete();
    }
}
