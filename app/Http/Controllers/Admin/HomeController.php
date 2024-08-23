<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $earnings = 22.89;
        $start = $request->query('date_from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $end = $request->query('date_to', Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'));

        $order = Order::query()
            ->whereIn('order_status', ['confirmed', 'completed'])
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $revenue = Order::query()
            ->where('order_status', 'completed')
            ->whereBetween('created_at', [$start, $end])
            ->sum('total');
        $product = Product::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $total = Order::query()
            ->whereBetween('created_at', [$start, $end])
            ->sum('total');

        $category = ProductCategory::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        return view('backend.index', compact( 'order', 'revenue', 'product', 'total','category','earnings'));
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
        //
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
    public function getChartData()
    {
        $months = range(1, 12); // Ví dụ: tháng từ 1 đến 12
        // Lấy dữ liệu số lượng sản phẩm theo tháng
        $productData = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
    
        // Lấy dữ liệu số lượng đơn hàng theo tháng
        $orderData = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
    
        // Lấy dữ liệu doanh thu theo tháng
        $revenueData = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

     

        // Định dạng dữ liệu cho biểu đồ
        $labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        $productCounts = array_values(array_replace(array_fill(0, 12, 0), $productData));
        $orderCounts = array_values(array_replace(array_fill(0, 12, 0), $orderData));
        $revenues = array_values(array_replace(array_fill(0, 12, 0), $revenueData));
    
        return response()->json([
           'labels' => array_map(fn($month) => "Tháng $month", $months),
            'productCounts' => $productCounts,
            'orderCounts' => $orderCounts,
            'revenues' => $revenues,
        ]);
    }
}


$labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        $productCounts = array_values(array_replace(array_fill(0, 12, 0), $productData));
        $orderCounts = array_values(array_replace(array_fill(0, 12, 0), $orderData));
        $revenues = array_values(array_replace(array_fill(0, 12, 0), $revenueData));
    
        return response()->json([
           'labels' => array_map(fn($month) => "Tháng $month", $months),
            'productCounts' => $productCounts,
            'orderCounts' => $orderCounts,
            'revenues' => $revenues,
        ]);
    }$labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
    $productCounts = array_values(array_replace(array_fill(0, 12, 0), $productData));
    $orderCounts = array_values(array_replace(array_fill(0, 12, 0), $orderData));
    $revenues = array_values(array_replace(array_fill(0, 12, 0), $revenueData));

    return response()->json([
       'labels' => array_map(fn($month) => "Tháng $month", $months),
        'productCounts' => $productCounts,
        'orderCounts' => $orderCounts,
        'revenues' => $revenues,
    ]);
}