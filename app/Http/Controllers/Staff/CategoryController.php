<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Formatter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_active', 1)->latest()->get();

        return $this->withSuccess($categories);
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
            'title' => 'string|max:56',
            'is_active' => 'nullable',
        ]);

        Category::create($att);

        return $this->withCreated('Category successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->withSuccess($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $att = $this->validate($request, [
            'title' => 'string|max:56',
            'is_active' => 'nullable',
        ]);

        $category->update($att);

        return $this->withSuccess('Category successfully created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->withSuccess('Succefully deleted.');
    }
}
