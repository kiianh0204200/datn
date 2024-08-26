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
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        $product_id = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1); // Đảm bảo số lượng là số nguyên
        $color = $request->input('color');
        $size = $request->input('size');

        $product = Product::find($product_id);

        if (!$product) {

        }

        $productOptionColor = ProductOption::where('id', $color)
            ->orWhere('name', $color)
            ->where('type', 'color')
            ->first();

        if (!$productOptionColor) {

        }

        $productOptionSize = ProductOption::where('id', $size)
            ->where('type', 'size')
            ->first();

        if (!$productOptionSize) {

        }

        $productOptionValue = ProductOptionValue::where('product_id', $product->id)
            ->where('size_id', $productOptionSize->id)
            ->where('color_id', $productOptionColor->id)
            ->first();

        if (!$productOptionValue || $productOptionValue->in_stock < $quantity) {
            return response()->json(['success' => false, 'message' => __('frontend.Product is out of stock!')]);
        }

        // add the product to cart
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->price($productOptionValue->price, $product->discount),
            'qty' => $quantity,
            'options' => [
                'size' => $productOptionSize->name,
                'color' => $productOptionColor->name,
                'image' => $product->thumbnail,
            ],
        ]);

        return response()->json(['success' => true, 'message' => __('frontend.Product added to cart!')]);
    }

    public function update(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        $quantity = (int) $request->input('qty', 1); // Đảm bảo số lượng là số nguyên
        $cartId = $request->input('cartId');

        // Validate the quantity before updating
        $cartItem = Cart::get($cartId);
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => __('frontend.Invalid cart item')]);
        }

        $productOptionValue = ProductOptionValue::where('product_id', $cartItem->id)
            ->where('size_id', $cartItem->options->size)
            ->where('color_id', $cartItem->options->color)
            ->first();

        if (!$productOptionValue || $productOptionValue->in_stock < $quantity) {
            return response()->json(['success' => false, 'message' => __('frontend.Product is out of stock!')]);
        }

        // update the item in cart
        Cart::update($cartId, [
            'qty' => $quantity,
        ]);

        return response()->json(['success' => true, 'message' => __('frontend.Cart updated!')]);
    }

    public function remove($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        // remove the item from the cart
        Cart::remove($id);

        return response()->json([
            'success' => true,
            'message' => __('frontend.Product removed from cart!')
        ]);
    }

    public function clear()
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => __('frontend.Please login to continue!')
            ], 403);
        }

        // clear the cart
        Cart::destroy();

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
