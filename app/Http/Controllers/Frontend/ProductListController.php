<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $sort = $request->query('sort', 'desc');
        $sortBy = $request->query('sort_by', 'id');
        $priceMin = $request->query('price_min');
        $priceMax = $request->query('price_max');
        $color = $request->query('color');
        $size = $request->query('size');
        $condition = $request->query('condition');
        $limit =  $request->query('limit', 12);
        $name = $request->query('name');

        $products = Product::query()
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($category, function ($query, $category) {
                $query->where('product_category_id', $category);
            })
            ->when($priceMin && $priceMax, function ($query) use($priceMin, $priceMax){
                $query->whereBetween('price', [$priceMin, $priceMax]);
            })
            ->when($color, function ($query, $color) {
                $query->whereHas('color', function ($query) use ($color) {
                    $query->where('color_id', $color);
                });
            })
            ->when($size, function ($query, $size) {
                $query->whereHas('size', function ($query) use ($size) {
                    $query->where('size_id', $size);
                });
            })
            ->when($condition, function ($query, $condition) {
                $query->where('condition', $condition);
            })
            ->orderBy($sortBy, $sort)
            ->paginate($limit);

        return view('frontend.pages.product-lists', compact('products'));
    }
}
