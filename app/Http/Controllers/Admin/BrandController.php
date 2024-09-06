<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;
use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('backend.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        $slug = $this->checkSlug($data['name']);

        Brand::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'is_active' => $data['status'],
        ]);

        toastr()->success(__('backend.Brand created successfully'));
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();

        $brand = Brand::findOrFail($id);

        $slug = $this->checkSlug($data['name']);

        $brand->update([
            'name' => $data['name'] ?? $brand->name,
            'slug' => $slug ?? $brand->slug,
            'description' => $data['description'] ?? $brand->description,
            'is_active' => $data['status'] ?? $brand->is_active,
        ]);

        toastr()->success(__('backend.Brand updated successfully'));
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        toastr()->success(__('backend.Brand deleted successfully'));
        return redirect()->route('admin.brand.index');
    }

    protected function checkSlug($name)
    {
        $checkSlug = Brand::where('slug', Str::slug($name))->exists();
        if ($checkSlug) {
            $slug = Str::slug($name) . '-' . uniqid();
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
}
