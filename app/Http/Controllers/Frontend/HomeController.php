<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\ProductCondition;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productNews = Product::query()
            ->with('productCategory')
            ->where('condition', ProductCondition::New->value)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $productHot = Product::query()
            ->with('productCategory')
            ->where('condition', ProductCondition::Hot->value)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $productBestSeller = Product::query()
            ->with('productCategory')
            ->where('condition', ProductCondition::BestSeller->value)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        $products = Product::query()
            ->with('productCategory')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        $blogs = Post::where('is_published', true)->orderBy('id', 'desc')->limit(3)->get();
        return view('frontend.pages.home', compact('productNews', 'productHot', 'productBestSeller', 'products', 'blogs'));
    }

    public function orderTrack(){
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)
            ->first();

        if ($order){
            if ($order->order_status =="pending"){
                return redirect()->route('frontend.home')->with('success', 'Mã đơn hàng'.' ' . $request->order_id . ' '.'của bạn đang chờ xử lý');
            }
            else if ($order->order_status =="confirmed"){
                return redirect()->route('frontend.home')->with('success', 'Mã đơn hàng'.' ' . $request->order_id . ' '.'của bạn đã được xác nhận');
            }
            else if ($order->order_status =="shipping"){
                return redirect()->route('frontend.home')->with('success', 'Mã đơn hàng'.' ' . $request->order_id . ' '.'của bạn đang được vận chuyển');
            }
            else if ($order->order_status =="completed"){
                return redirect()->route('frontend.home')->with('success', 'Mã đơn hàng'.' ' . $request->order_id . ' '.'của bạn đã được giao thành công');
            }
        }
        else{
            return back()->with('error', 'Mã đơn hàng' . $request->order_id . 'của bạn không tồn tại');
        }
}

}
