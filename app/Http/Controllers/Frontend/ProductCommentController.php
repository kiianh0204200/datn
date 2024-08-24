<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        $product = Product::find($request->product_id);

        ProductComment::create([
            'user_id' => auth()->id(),
            'email' => $request->email,
            'name' => $request->name,
            'messages' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $product->id,
            'is_active' => '1',
        ]);

        toastr()->success(__('frontend.Comment created successfully.'));

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
