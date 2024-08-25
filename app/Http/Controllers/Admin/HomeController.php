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

        return view('backend.index', compact( 'order', 'revenue', 'product', 'total','category'));
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
}
