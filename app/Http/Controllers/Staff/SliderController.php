<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $sliders = Slider::with('image')->orderBy('id', 'DESC')->paginate($perPage);

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
        ]);
        $slider_image = null;
        if ($request->hasFile('image')) {
            $slider_image = $this->uploadFile($request->file('image'));
            unset($att['image']);
        }

        try {
            DB::beginTransaction();
            $slider = Slider::create($att);
            if (! $slider) {
                throw new Exception('Slider not created!');
            }
            if ($slider_image) {
                $slider->image()->create([
                    'type' => 'slider',
                    'url' => $slider_image,
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Slider successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return $this->withSuccess($slider->load('image'));
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
            'image' => ['required'],
            'status' => 'required|digits_between:0,1',
        ]);
        $slider = Slider::find($att['id']);
        unset($att['id']);
        $slider_image = null;
        if ($request->hasFile('image')) {
            $slider_image = $this->uploadFile($request->file('image'));
            if ($slider?->image?->url) {
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
            if ($slider_image) {
                $slider->image()->create([
                    'type' => 'slider',
                    'url' => $slider_image,
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Slider successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $file = $slider->image()->first();
        if ($file) {
            $this->deleteFile($file);
            $slider->image()->delete();
        }

        $slider->delete();

        return $this->withSuccess('Slider successfully delete.');
    }
}
