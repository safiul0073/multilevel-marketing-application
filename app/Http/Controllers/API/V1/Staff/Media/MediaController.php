<?php

namespace App\Http\Controllers\API\V1\Staff\Media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class MediaController extends Controller
{
    use Formatter, MediaOperator;

    public function storeImage (Request $request) {

        $this->validate($request, [
            "id"    => 'required|numeric',
            'image' => ['required', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(2)->max(10 * 1000)],
            'type'  => 'required|string'
        ]);

        $model = $this->getModel($request->type, $request->id);

        try {
            DB::beginTransaction();

            $is_multi = in_array( $request->type, [
                Media::PRODUCT_THAMNAIL,
                Media::PRODUCT_GALLERY,
                Media::REWARD,
                Media::GALLERY
            ]);


            $image = $this->uploadFile($request->file('image'));

            $this->imageUploadDatabase(
                $is_multi,
                $model,
                [
                   'url' => $image,
                   'type' => $request->type,
                ]);
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess("Image uploaded.");
    }

    public function deleteImage (Media $image) {

        if ($image->url && $this->deleteFile($image->url)) {
            $image->delete();
            return $this->withSuccess("Successfully deleted.");
        }
        return $this->withErrors("Deletion failed!");
    }
}
