<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
      
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
            'order_status' => ['required_without:payment_status', 'string', 'max:255'],
            
        ]);
    
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $data['order_status'] ?? $order->order_status,
            'payment_status' => $data['payment_status'] ?? $order->payment_status,
        ]);
    
        // Trừ số lượng sản phẩm và số lượng voucher khi đơn hàng hoàn thành
        if ($request->input('order_status') === 'completed') {
            // Trừ số lượng sản phẩm trong kho
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            foreach ($orderDetails as $orderDetail) {
                $color = ProductOption::where('name', $orderDetail->color)->first();
                $size = ProductOption::where('name', $orderDetail->size)->first();
                $productOptionValue = ProductOptionValue::query()
                    ->where('product_id', $orderDetail->product_id)
                    ->where('color_id', $color->id)
                    ->where('size_id', $size->id)
                    ->first();
                
                // Kiểm tra nếu còn sản phẩm trong kho
                if ($productOptionValue->in_stock >= $orderDetail->quantity) {
                    $productOptionValue->decrement('in_stock', $orderDetail->quantity);
                } else {
                    toastr()->warning('Số lượng sản phẩm không đủ trong kho');
                    return back();
                }
            }
    
            // Trừ số lượng voucher nếu đơn hàng hoàn thành
            $voucherCode = $order->voucher_code;
            $voucher = Voucher::where('code', $voucherCode)->first();
    
            if ($voucher) {
                // Trừ số lượng voucher còn lại
                if ($voucher->voucher_quantity > 0) {
                    $voucher->decrement('voucher_quantity', 1);
                } else {
                    toastr()->warning('Số lượng voucher đã hết');
                }
    
                // Lưu thông tin sử dụng voucher vào bảng voucher_usages
                VoucherUsage::create([
                    'user_id' => $order->user_id, 
                    'voucher_id' => $voucher->id,
                    'order_id' => $order->id,
                    'used_at' => now(),
                ]);
            }
        }
    
        // Cập nhật số lượng sản phẩm khi hủy đơn hàng
        if ($request->input('order_status') === 'cancel') {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            foreach ($orderDetails as $orderDetail) {
                $color = ProductOption::where('name', $orderDetail->color)->first();
                $size = ProductOption::where('name', $orderDetail->size)->first();
                ProductOptionValue::query()
                    ->where('product_id', $orderDetail->product_id)
                    ->where('color_id', $color->id)
                    ->where('size_id', $size->id)
                    ->increment('in_stock', $orderDetail->quantity);
            }
        }
    
        toastr()->success('Cập nhật trạng thái đơn hàng thành công');
        return back();
    }
    
    
    

    
    
    public function cancelOrder(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Xác thực lý do hủy
    $request->validate([
        'cancellation_reason' => 'required|string|max:255',
    ]);

    // Cập nhật trạng thái đơn hàng và lưu lý do hủy
    $order->update([
        'order_status' => 'cancelled',
        'cancellation_reason' => $request->input('cancellation_reason'),
    ]);

    toastr()->success('Đơn hàng đã được hủy thành công.');
    return redirect()->route('frontend.pages.account');
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
