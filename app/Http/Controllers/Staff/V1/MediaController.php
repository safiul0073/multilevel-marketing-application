<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class MediaController extends Controller
{
    use Formatter, MediaOperator;

    public function storeImage (Request $request) {

        $this->validate($request, [
            "id"    => 'required|numeric',
            'image' => ['required', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
            'type'  => 'required|string'
        ]);
        $model = null;
        if (in_array($request->type, ['thamnail', 'gellary'])) {
            $model = Product::findOrFail((int) $request->id);
        }else if ($request->type == 'slider') {
            $model = Slider::findOrFail((int) $request->id);
        }else {
            $model = User::findOrFail((int) $request->id);
        }
        $image = $this->uploadFile($request->file('image'));
        if ($request->type == 'thamnail') {
            $thamnail_file = $model->images()->where('type', 'thamnail')->first();
            if ($thamnail_file) {
                $this->deleteFile($thamnail_file);
                $model->images()->where('type', 'thamnail')->delete();
            }
        }
        $model->images()->create([
            'url' => $image,
            'type' => $request->type,
        ]);

        return $this->withSuccess("Image uploaded.");
    }

    public function deleteImage (Media $image) {


        if ($image->url) {
            $this->deleteFile($image->url);
            $image->delete();
            return $this->withSuccess("Successfully deleted.");
        }
        return $this->withErrors("Deletion failed!");
    }
}
