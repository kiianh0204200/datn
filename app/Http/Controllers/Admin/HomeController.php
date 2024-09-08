<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $earnings = 22.89;
        $start = $request->query('date_from', Carbon::now()->startOfYear()->format('Y-m-d'));
        $end = $request->query('date_to', Carbon::now()->endOfYear()->format('Y-m-d H:i:s'));

        // Lấy dữ liệu order status
        $orderStatusData = $this->getOrderStatusData($start, $end);

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

        // Fetch monthly data for chart
        $monthlyData = Order::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as orders, SUM(total) as revenue')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Prepare data for all 12 months
        $months = range(1, 12);
        $orderCounts = [];
        $revenues = [];

        foreach ($months as $month) {
            $data = $monthlyData->get($month, ['orders' => 0, 'revenue' => 0]);
            $orderCounts[] = $data['orders'];
            $revenues[] = $data['revenue'];
        }

        return view('backend.index', compact('order', 'revenue', 'product', 'total', 'category', 'earnings', 'months', 'orderCounts', 'revenues', 'orderStatusData'));
    }

    /**
     * Get order status data between given dates.
     */
    private function getOrderStatusData($start, $end)
    {
        return Order::query()
            ->select('order_status', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('order_status')
            ->pluck('count', 'order_status')
            ->toArray();
    }
}