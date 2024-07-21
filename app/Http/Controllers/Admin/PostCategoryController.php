<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategory\StoreRequest;
use App\Http\Requests\Admin\PostCategory\UpdateRequest;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostCategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('backend.post-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::get();

        return view('backend.post-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        $slug = $this->checkSlug($data['name']);

        PostCategory::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'slug' => 'blog' . '-'. $slug,
        ]);

        toastr()->success(__('backend.Post Category created successfully'));
        return redirect()->route('admin.post-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = PostCategory::find($id);

        if (!$category) {
            toastr()->error(__('backend.Category not found.'));
            return redirect()->back();
        }
        return view('backend.post-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();

        $category = PostCategory::find($id);
        if (!$category) {
            toastr()->error('Category not found.');
            return redirect()->back();
        }

        $slug = $this->checkSlug($data['name']);

        $category->name = $data['name'] ?? $category->name;
        $category->description = $data['description'] ?? $category->description;
        $category->slug = 'blog' . '-'. $slug ?? $category->slug;
        $category->save();

        toastr()->success(__('backend.Post Category updated successfully'));
        return redirect()->route('admin.post-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = PostCategory::find($id);
        if (!$category) {
            toastr()->error('Category not found.');
            return redirect()->back();
        }
        $category->delete();
        toastr()->success(__('backend.Post Category deleted successfully'));
        return redirect()->route('admin.post-category.index');
    }

    protected function checkSlug($name)
    {
        $checkSlug = PostCategory::where('slug', Str::slug($name))->exists();
        if ($checkSlug) {
            $slug = Str::slug($name) . '-' . uniqid();
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
}
