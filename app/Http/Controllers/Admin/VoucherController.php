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

        if (!empty($validatedData['voucher_code'])) {
            $voucher = Voucher::where('code', $validatedData['voucher_code'])->first();

            if ($voucher && $voucher->isValid()) {
                // Áp dụng giảm giá từ voucher vào giá sản phẩm
                $validatedData['price'] = $this->applyVoucherDiscount($voucher, $validatedData['price']);
            } else {
                return redirect()->back()->withErrors(['voucher_code' => 'Voucher không hợp lệ hoặc đã hết hạn']);
            }
        }

        Product::create($validatedData);

        toastr()->success(__('Voucher created successfully'));
        return redirect()->route('admin.voucher.index');
    }

    // Hàm tính toán giá sau khi áp dụng voucher
    protected function applyVoucherDiscount(Voucher $voucher, $price)
    {
        if ($voucher->discount_type === 'percentage') {
            return $price * (1 - $voucher->discount_value / 100);
        }

        return max(0, $price - $voucher->discount_value);
    }

       
        
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

        if (isset($data['image'])) {
            $data['image'] = Files::upload($data['image'], 'voucher');
        } else {
            $data['image'] = $voucher->image;
        }

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
}
