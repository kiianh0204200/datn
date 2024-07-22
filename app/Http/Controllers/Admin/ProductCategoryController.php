<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductCategoryDataTable;
use App\Helpers\Files;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategory\StoreRequest;
use App\Http\Requests\Admin\ProductCategory\UpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductCategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::with('children')->get();

        return view('backend.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        $data['image'] = Files::upload($data['image'], 'product-category');

        $slug = $this->checkSlug($data['name']);

        ProductCategory::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'image' => $data['image'],
            'is_active' => $data['status'] ?? false,
            'slug' => $slug,
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        toastr()->success(__('backend.Category created successfully'));
        return redirect()->route('admin.category.index');
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
        $category = ProductCategory::find($id);
        $categories = ProductCategory::with('children')->get();
        if (!$category) {
            toastr()->error(__('backend.Category not found.'));
            return redirect()->back();
        }
        return view('backend.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();
        $category = ProductCategory::findOrFail($id);

        if (isset($data['image']) && $data['image']) {
            $image = Files::upload($data['image'], 'product-category');
        } else {
            $image = $category->image;
        }

        $category->update([
            'name' => $data['name'] ?? $category->name,
            'image' => $image,
            'description' => $data['description'] ?? $category->description,
            'is_active' => $data['status'] ?? $category->is_active,
            'parent_id' => $data['parent_id'] ?? $category->parent_id,
        ]);

        toastr()->success(__('backend.Category updated successfully'));
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::find($id);

        $category->delete();
        toastr()->success(__('backend.Category deleted successfully'));
        return redirect()->route('admin.category.index');
    }

    protected function checkSlug($name)
    {
        $checkSlug = ProductCategory::where('slug', Str::slug($name))->exists();
        if ($checkSlug) {
            $slug = Str::slug($name) . '-' . uniqid();
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
}
