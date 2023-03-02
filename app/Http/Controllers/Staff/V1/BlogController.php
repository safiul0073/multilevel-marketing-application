<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class BlogController extends Controller
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
        $blog = Blog::with('image')->orderBy('id', 'DESC')->paginate($perPage);

        return $this->withSuccess($blog);
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
            'title' => 'required|string|max:256',
            'content' => 'required|string',
            'status' => 'nullable',
            'image' => ['required', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000) ]
        ]);

        try {
            DB::beginTransaction();

            // creating a blog row
            $blog = Blog::create([
                'title' => $att['title'],
                'content' => $att['content'],
                'status' => $request->status ? $request->status : 1
            ]);

            // uploading image and creating new row for blog in media
            $this->singleFileUpload(
                $this->uploadFile($request->image),
                $blog,
                'blog'
            );

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return $this->withSuccess($blog->load('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $att = $this->validate($request, [
            'title' => 'required|string|max:256',
            'content' => 'required|string',
            'status' => 'nullable',
            'image' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000) ]
        ]);

        try {
            DB::beginTransaction();

            // creating a blog row
            $blog->update([
                'title' => $att['title'],
                'content' => $att['content'],
                'status' => $request->status ? $request->status : 1
            ]);

            // uploading image and creating new row for blog in media
            if ($request->hasFile('image')) {

                $this->imageFullyDelete(false, $blog, 'blog');

                $this->singleFileUpload(
                    $this->uploadFile($request->image),
                    $blog,
                    'blog'
                );
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try {
            DB::beginTransaction();

            $this->imageFullyDelete(false, $blog, 'blog');

            $blog->delete();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully deleted.');
    }
}
