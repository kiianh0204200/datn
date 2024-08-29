<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VoucherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voucher\StoreVoucherRequest;
use App\Http\Requests\Admin\Voucher\UpdateVoucherRequest;
use App\Models\Voucher;
use App\Helpers\Files;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(VoucherDataTable $voucherDataTable)
    {
        return $voucherDataTable->render('backend.voucher.index');
    }

    public function create()
    {
        return view('backend.voucher.create');
    }

    public function store(StoreVoucherRequest $request)
    {
        $data = $request->safe()->all();
       

    
        Voucher::create([
            'code' => $data['code'] ,
            'description' => $data['description'],
            'discount_type' => $data['discount_type'],
            'discount_value' => $data['discount_value'] ?? null,
            'usage_limit' => $data['usage_limit'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'],
            'status' => $data['status']?? null,
            'min_order_value' => $data['min_order_value']?? null,
        ]);

        
        toastr()->success(__('Voucher created successfully'));
        return redirect()->route('admin.voucher.index');
        
    }

    public function show(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('backend.voucher.show', compact('voucher'));
    }

    public function edit(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('backend.voucher.edit', compact('voucher'));
    }

    public function update(UpdateVoucherRequest $request, string $id)
    {
        $data = $request->safe()->all();
        $voucher = Voucher::findOrFail($id);

      

        $voucher->update($data);

        toastr()->success(__('Voucher updated successfully'));
        return redirect()->route('admin.voucher.index');
    }

    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        toastr()->success(__('Voucher deleted successfully'));
        return redirect()->route('admin.voucher.index');
    }

    // Phương thức áp dụng voucher
    // app/Http/Controllers/VoucherController.php

public function applyVoucher(Request $request)
{
    
    $voucherCode = $request->input('voucher_code');
    
    \Log::info('Voucher code received: ' . $voucherCode);
    if (empty($voucherCode)) {
        return response()->json([
            'success' => false,
            'message' => 'Voucher code is required.'
        ]);
    }
    $voucher = Voucher::where('code', $voucherCode)->first();

    if (!$voucher) {
        \Log::info('Voucher not found: ' . $voucherCode);
    } elseif (!$voucher->isValid()) {
        \Log::info('Voucher is invalid or expired: ' . $voucherCode);
    }

    if ($voucher && $voucher->isValid()) {
        // Tính toán giảm giá
        $discountAmount = $voucher->discount_value;
        $totalAmount = \Cart::subTotal() - $discountAmount;

        return response()->json([
            'success' => true,
            'discount_amount' => $discountAmount,
            'total_amount' => formatPrice($totalAmount)
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Invalid or expired voucher code.'
    ]);
}


}
