<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::content();
        return view('frontend.pages.cart', compact('carts'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $color = $request->input('color');
        $size = $request->input('size');

        $product = Product::where('id', $product_id)->first();

        if (!$product) {
            return response()->json(['success' => false, 'message' => __('frontend.Product not found!')]);
        }

        $productOptionColor = ProductOption::query()
            ->where('id', $color)
            ->orWhere('name', $color)
            ->where('type', 'color')
            ->first();

        if (!$productOptionColor) {
            return response()->json(['success' => false, 'message' => __('frontend.Color not found!')]);
        }

        $productOptionSize = ProductOption::query()
            ->where('id', $size)
            ->where('type', 'size')
            ->first();

        if (!$productOptionSize) {
            return response()->json(['success' => false, 'message' => __('frontend.Size not found!')]);
        }

        $productOptionValue = ProductOptionValue::query()
            ->where('product_id', $product->id)
            ->where('size_id', $productOptionSize->id)
            ->where('color_id', $productOptionColor->id)
            ->first();

        if ($productOptionValue->in_stock < $quantity) {
            return response()->json(['success' => false, 'message' => __('frontend.Product is out of stock!')]);
        }

        // add the product to cart
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->price($productOptionValue->price, $product->discount),
            'qty' => $quantity,
            'options' => array(
                'size' => $productOptionSize->name,
                'color' => $productOptionColor->name,
                'image' => $product->thumbnail,
            ),
        ));

        return response()->json(['success' => true, 'message' => __('frontend.Product added to cart!')]);

    }

    public function update(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        $quantity = $request->input('qty');
        $cartId = $request->input('cartId');
        // update the item on cart
        $cart = Cart::update($cartId, array(
            'qty' => $quantity,
        ));

        toastr()->success(__('frontend.Cart updated!'));
        return response()->json(['success' => true, 'message' => __('frontend.Cart updated!')]);
    }

    public function remove($id)
    {
        if (!auth()->user()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        // remove the item on cart
        Cart::remove($id);

        return response()->json([
            'success' => true,
            'message' => __('frontend.Product removed from cart!')
        ]);
    }

    public function clear()
    {
        if (!auth()->user()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        // clear the cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => __('frontend.Cart cleared!')
        ]);
    }

    private function price($price, $discount)
    {
        if ($discount) {
            $price = $price - ($price * $discount / 100);
        }
        return $price;
    }
}
