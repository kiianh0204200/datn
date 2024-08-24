<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductOptionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductOption\StoreRequest;
use App\Http\Requests\Admin\ProductOption\UpdateRequest;
use App\Models\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductOptionDataTable $dataTable)
    {
        return $dataTable->render('backend.product-option.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product-option.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        ProductOption::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'value' => $data['value'] ?? null,
        ]);

        toastr()->success(__('backend.Product Option created successfully'));

        return redirect()->route('admin.product-option.index');
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
        $productOption = ProductOption::findOrFail($id);

        return view('backend.product-option.edit', compact('productOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();

        $productOption = ProductOption::findOrFail($id);

        $productOption->update([
            'name' => $data['name'] ?? $productOption->name,
            'type' => $data['type'] ?? $productOption->type,
            'value' => $data['value'] ?? $productOption->value,
        ]);

        toastr()->success(__('backend.Product Option updated successfully'));

        return redirect()->route('admin.product-option.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductOption::where('id', $id)->first()?->delete();

        toastr()->success(__('backend.Product Option deleted successfully'));
        return redirect()->route('admin.product-option.index');
    }
}
