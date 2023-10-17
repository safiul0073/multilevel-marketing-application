<?php

namespace App\Http\Controllers\API\V1\Staff\Slider;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Slider;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class SliderController extends Controller
{
    use Formatter, MediaOperator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }

        $eger_load = 'images';
        if($request->is_slider == 1) {
            $eger_load = 'image';
        }

        $sliders = Slider::with($eger_load)
                ->where('is_slider', $request->is_slider)
                ->orderBy('id', 'DESC')->paginate($perPage);

        return $this->withSuccess($sliders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $att = $this->validate($request, [
            'title' => 'required|string|max:100',
            'image' => ['required',File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)],
            'status' => 'required|digits_between:0,1',
            'is_slider'  => 'nullable'
        ]);

        $slider_image = null;
        unset($att['image']);

        try {
            DB::beginTransaction();
            $slider = Slider::create($att);
            if (! $slider) {
                throw new Exception('Slider not created!');
            }

            if ($request->hasFile('image')) {
                $slider_image = $this->uploadFile($request->file('image'));
                if (!$request->is_slider) {
                    $slider->image()->create([
                        'type' => Media::SLIDER,
                        'url' => $slider_image,
                    ]);
                }else {
                    $slider->images()->create([
                        'type' => Media::GALLERY,
                        'url' => $slider_image,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        if ($slider->is_slider == 1) {
            return $this->withSuccess($slider->load('image'));
        }
        return $this->withSuccess($slider->load('images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $att = $this->validate($request, [
            'id'    => 'required|numeric|exists:sliders,id',
            'title' => 'required|string|max:100',
            'image' => ['nullable'],
            'status' => 'required|digits_between:0,1',
        ]);
        $slider = Slider::find($att['id']);
        unset($att['id']);
        $slider_image = null;
        if ($request->hasFile('image')) {
            $slider_image = $this->uploadFile($request->file('image'));
            if ($slider->is_slider === 1 && $slider?->image?->url) {
                $this->deleteFile($slider?->image?->url);
                $slider->image()->delete();
            }
            unset($att['image']);
        }

        try {
            DB::beginTransaction();
            $s = $slider->update($att);
            if (! $s) {
                throw new Exception('Slider not updated!');
            }
            if ($slider_image && $slider->is_slider === 1) {
                $slider->image()->create([
                    'type' => Media::SLIDER,
                    'url' => $slider_image,
                ]);
            }

            if ($slider_image && $slider->is_slider === 2) {
                $slider->images()->create([
                    'type' => Media::GALLERY,
                    'url' => $slider_image,
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {

        try {
            DB::beginTransaction();
            if ($slider->is_slider == 1) {
                $file = $slider->image()->first();
                if ($file) {
                    $this->deleteFile($file->url);
                    $slider->image()->delete();
                }
            }else {
                $files = $slider->images;
                if (count($files)){
                    foreach($files as $file) {
                        $this->deleteFile($file->url);
                    }
                    $slider->images()->delete();
                }
            }

            $slider->delete();
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully deleted.');
    }
}
