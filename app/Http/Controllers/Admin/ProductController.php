<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Helpers\Files;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = ProductCategory::get();
        $colors = ProductOption::where('type', 'color')->get();
        $sizes = ProductOption::where('type', 'size')->get();
        return view('backend.product.create', compact('brands', 'categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        $slug = $this->checkSlug($data['product_name']);

        $thumbnail = Files::upload($data['thumbnail'], 'products');

        $product = Product::create([
            'brand_id' => $data['brand_id'],
            'product_category_id' => $data['category_id'],
            'name' => $data['product_name'],
            'subtitle' => $data['sub_content'] ?? null,
            'description' => $data['description'] ?? null,
            'thumbnail' => $thumbnail,
            'slug' => $slug,
            'price' => $data['price'],
            'discount' => $data['discount'],
            'condition' => $data['condition'],
            'is_active' => $data['status'],
            'sku' => $data['sku'] ?? null,
        ]);

        if ($product) {
            $this->createProductOptionValue($product, $data);
        }

        if ($product) {
            $this->createProductImage($product, $data);
        }

        toastr()->success(__('backend.Product created successfully'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::query()
            ->leftJoin('product_option_values', 'products.id', '=', 'product_option_values.product_id')
            ->leftJoin('product_options as product_option_color', 'product_option_values.color_id', '=', 'product_option_color.id')
            ->leftJoin('product_options as product_options_size', 'product_option_values.size_id', '=', 'product_options_size.id')
            ->select([
                'products.*', 'product_option_color.name as color_name', 'product_options_size.name as size_name',
                'product_option_values.in_stock', 'product_option_values.price',
                'product_option_color.value as color_value'
            ])
            ->where('products.id', $id)
            ->get();
        $product = Product::query()->with('comments')->where('id', $id)->first();
        $comments = ProductComment::query()->where('product_id', $id)->cursorPaginate(10);
        $images = ProductImage::where('product_id', $id)->get();

        return view('backend.product.detail', compact('products', 'images', 'product', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::get();
        $categories = ProductCategory::get();
        $colors = ProductOption::where('type', 'color')->get();
        $sizes = ProductOption::where('type', 'size')->get();
        return view('backend.product.edit', compact('product', 'brands', 'categories', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();
        logger($data);
        $product = Product::findOrFail($id);

        $slug = $this->checkSlug($data['product_name']);

        if (isset($data['thumbnail']) && $data['thumbnail']) {
            $thumbnail = Files::upload($data['thumbnail'], 'products');
        } else {
            $thumbnail = $product->thumbnail;
        }

        $product->update([
            'brand_id' => $data['brand_id'] ?? $product->brand_id,
            'product_category_id' => $data['category_id'] ?? $product->product_category_id,
            'name' => $data['product_name'] ?? $product->name,
            'subtitle' => $data['sub_content'] ?? $product->subtitle,
            'description' => $data['description'] ?? $product->description,
            'thumbnail' => $thumbnail,
            'slug' => $slug,
            'price' => $data['price'] ?? $product->price,
            'discount' => $data['discount'] ?? $product->discount,
            'condition' => $data['condition'] ?? $product->condition,
            'is_active' => $data['status'] ?? $product->is_active,
            'sku' => $data['sku'] ?? $product->sku,
        ]);

        if (isset($data['size']) && $data['size']
            && isset($data['color']) && $data['color']
            && isset($data['stock']) && $data['stock']
            && isset($data['price_option']) && $data['price_option']) {
            ProductOptionValue::where('product_id', $product->id)->delete();

            $this->createProductOptionValue($product, $data);
        }

        if (isset($data['images']) && $data['images']) {
            ProductImage::where('product_id', $product->id)->delete();

            $this->createProductImage($product, $data);
        }

        toastr()->success(__('backend.Product updated successfully'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)?->delete();

        toastr()->success(__('backend.Product deleted successfully'));

        return redirect()->route('admin.product.index');
    }

    protected function checkSlug($name)
    {
        $checkSlug = Product::where('slug', Str::slug($name))->exists();
        if ($checkSlug) {
            $slug = Str::slug($name) . '-' . uniqid();
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }

    protected function createProductOptionValue($product, $data): void
    {
        foreach ($data['color'] as $key => $value) {
            ProductOptionValue::create([
                'product_id' => $product->id,
                'color_id' => $value,
                'size_id' => $data['size'][$key],
                'in_stock' => $data['stock'][$key],
                'price' => $data['price_option'][$key],
            ]);
        }
    }

    protected function createProductImage($product, $data): void
    {
        $images = [];
        foreach ($data['images'] as $image) {
            $images[] = Files::upload($image, 'products');
        }

        foreach ($images as $image) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $image,
            ]);
        }
    }

    public function updateCommentStatus(Request $request, $commentId)
    {
        $comment = ProductComment::findOrFail($commentId);
        $comment->update([
            'is_active' => $request->status
        ]);
        toastr()->success(__('backend.Comment updated successfully'));
        return redirect()->back();
    }
}
