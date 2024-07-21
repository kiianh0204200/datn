<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('backend.order.index');
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
        $order = Order::with(['orderItems', 'user'])->findOrFail($id);

        return view('backend.order.show', compact('order'));
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
        $data = $request->validate([
            'order_status' => ['required', 'string', 'max:255'],
            'payment_status' => ['required', 'string', 'max:255'],
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'order_status' => $data['order_status'] ?? $order->order_status,
            'payment_status' => $data['payment_status'] ?? $order->payment_status,
        ]);

        toastr()->success('Cập nhật trạng thái đơn hàng thành công');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        toastr()->success('Xóa đơn hàng thành công');
        return back();
    }
}
