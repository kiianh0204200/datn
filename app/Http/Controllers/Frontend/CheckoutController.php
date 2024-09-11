<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\Voucher;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::content();

        return view('frontend.pages.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $subtotal = \Cart::subTotal();
            $user = auth()->user();
            $voucherCode = $request->input('voucher_code');
    
            // Kiểm tra và áp dụng voucher
            $voucher = Voucher::where('code', $voucherCode)
                ->where('status', 1 ) // Kiểm tra trạng thái active
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();
                \Log::info('Voucher details: ', $voucher ? $voucher->toArray() : ['message' => 'Voucher not found']);
            if ($voucher) {
                $discount = $voucher->discount_value;
                if ($voucher->discount_type == 0) { // Phần trăm giảm giá
                    $discountAmount = ($subtotal * $discount) / 100;
                } else { // Giảm giá cố định
                    $discountAmount = $discount;
                }
    
                // Kiểm tra giá trị đơn hàng tối thiểu
                if ($subtotal < $voucher->min_order_value) {
                    throw new \Exception('Order value is below the minimum required for the voucher.');
                }
            } else {
                $discountAmount = 0;
            }
    
            // Tính tổng tiền sau khi áp dụng voucher
            $total = $subtotal - $discountAmount;
            if ($total < 0) {
                $total = 0; // Đảm bảo tổng tiền không âm
            }
            \Log::info('Subtotal: ' . $subtotal);
            \Log::info('Total after discount: ' . $total);
    
            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->id,
                'order_id' => uniqid('Order-'),
                'total' => $total,
                'payment_method' => $request->payment_method ?? 'Ship COD',
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'address' => $request->address,
                'address_2' => $request->address_2 ?? null,
                'notes' => $request->notes ?? null,
                'voucher_code' => $voucherCode,
                'discount_amount' => $discountAmount,
            ]);
    
            // Tạo chi tiết đơn hàng
            foreach (\Cart::content() as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'color' => $item->options->color,
                    'size' => $item->options->size,
                    'quantity' => $item->qty,
                    'total' => $item->price * $item->qty,
                    'image' => $item->options->image,
                ]);
            }
    
            // Cập nhật số lượng sản phẩm
            if ($order->orderDetails) {
                foreach ($order->orderDetails as $orderDetail) {
                    // Xử lý chi tiết đơn hàng
                    $color = ProductOption::where('name', $orderDetail->color)->first();
                    $size = ProductOption::where('name', $orderDetail->size)->first();
                    ProductOptionValue::query()
                        ->where('product_id', $orderDetail->product_id)
                        ->where('color_id', $color->id)
                        ->where('size_id', $size->id)
                        ->decrement('in_stock', $orderDetail->quantity);
                }
            } else {
                \Log::info('No order details found for order ID: ' . $order->id);
            }
    
            // Gửi email
            Mail::to($user->email)->send(new OrderShipped($order));
    
            // Xóa giỏ hàng
            Cart::destroy();
    
            DB::commit();
    
            // Xử lý thanh toán với VnPay
            if ($request->payment_method == 'VnPay') {
                $response = $this->vnPay($order->order_id);
                if ($response['code'] == '00') {
                    return redirect()->away($response['data']);
                }
            }
    
            return redirect()->route('frontend.home')->with('success', 'Đơn hàng đang được xử lí');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('frontend.home')->with('error', 'Đơn hàng không được thanh toán thành công: ' . $exception->getMessage());
        }
    }
    

    private function vnPay($orderId)
    {
        $vnpReturnUrl = env('APP_URL') . '/payment-return';
        $vnp_TmnCode = env('VNP_TMNCODE'); //Mã website tại VNPAY
        $vnpUrl = env('VNP_URL');

        $order = Order::where('order_id', $orderId)->first();

        $vnpTxnRef = $order->order_id;
        $vnp_OrderInfo = "Thanh toan GD:" . $order->order_id;
        $vnp_OrderType = 'other';
        $vnp_Amount = number_format($order->total * 100, 0, '', '');
        $vnp_Locale = 'vn';
        $vnp_IpAddr = "1.55.197.187";

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnpReturnUrl,
            "vnp_TxnRef" => $vnpTxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpUrl = $vnpUrl . "?" . $query;

        if (env('VNP_HASHSECRET')) {
            $vnpSecureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
            $vnpUrl .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return array(
            'code' => '00', 'message' => 'success', 'data' => $vnpUrl
        );
    }

    public function paymentReturn(Request $request)
    {
        $inputData = $request->toArray();
        $returnData = [];

        foreach ($request->all() as $item) {
            if ((substr($item, 0, 4) == "vnp_")) {
                $returnData[$item] = $item;
            }
        }

        $vnpSecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        $vnpTranId = $inputData['vnp_TransactionNo'];
        $vnp_Amount = $inputData['vnp_Amount'] / 100;

        $orderId = $inputData['vnp_TxnRef'];

        try {
            if ($secureHash == $vnpSecureHash) {

                $order = Order::where('order_id', $orderId)->first();

                if ($order != NULL) {
                    if ($order->total == $vnp_Amount) {
                        if ($order->payment_status !== NULL && $order->payment_status == 'pending') {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $order->update([
                                    'payment_status' => 'paid',
                                    'payment_id' => $vnpTranId,
                                    'order_status' => 'confirmed',
                                ]);

                                $order = Order::where('order_id', $orderId)->first();
                                $orderDetails = OrderDetail::where('order_id', $order->id)->get();
                                // If Payment success
                                // Update quantity product
                                foreach ($orderDetails as $orderDetail) {
                                    $color = ProductOption::where('name', $orderDetail->color)->first();
                                    $size = ProductOption::where('name', $orderDetail->size)->first();
                                    ProductOptionValue::query()
                                        ->where('product_id', $orderDetail->product_id)
                                        ->where('color_id', $color->id)
                                        ->where('size_id', $size->id)
                                        ->decrement('in_stock', $orderDetail->quantity);
                                }
                                if ($request->input('order_status') === 'completed') {
                                    // Giả sử Order có quan hệ với Voucher qua voucher_id
                                    if ($order->voucher_id) {
                                        $voucher = Voucher::find($order->voucher_id);
                            
                                        if ($voucher && $voucher->voucher_quantity > 0) {
                                            // Trừ 1 vào voucher_quantity
                                            $voucher->decrement('voucher_quantity', 1);
                                        }
                                    }
                                }

                                Mail::to(auth()->user()->email)->send(new OrderShipped($order));

                                Cart::destroy();

                                return redirect()->route('frontend.home')->with('success', 'Đơn hàng đã được thanh toán thành công');
                            } elseif ($inputData['vnp_ResponseCode'] == 11) {
                                $order->update([
                                    'payment_status' => 'failed',
                                    'payment_id' => $vnpTranId,
                                    'order_status' => 'pending',
                                ]);

                                return redirect()->route('frontend.home')->with('error', 'Giao dịch không thành công');
                            } elseif ($inputData['vnp_ResponseCode'] == '24') {
                                $order->update([
                                    'payment_status' => 'failed',
                                    'payment_id' => $vnpTranId,
                                    'order_status' => 'pending',
                                ]);

                                return redirect()->route('frontend.home')->with('error', 'Giao dịch không thành công');
                            }
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                            return redirect()->route('frontend.home')->with('error', 'Đơn hàng đã được xác nhận');
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                        return redirect()->route('frontend.home')->with('error', 'Số tiền không hợp lệ');
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                    return redirect()->route('frontend.home')->with('error', 'Đơn hàng không tồn tại');
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
                return redirect()->route('frontend.home')->with('error', 'Chữ ký không hợp lệ');
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
            return redirect()->route('frontend.home')->with('error', 'Đơn hàng không thanh toán thành công');
        }
    }
}
