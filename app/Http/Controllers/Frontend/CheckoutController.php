<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductOptionValue;
use App\Models\User;
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
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'order_id' => uniqid('Order-'),
                'total' => $subtotal,
                'payment_method' => $request->payment_method ?? 'Ship COD',
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'address' => $request->address,
                'address_2' => $request->address_2 ?? null,
                'notes' => $request->notes ?? null,
            ]);

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
            DB::commit();

            if ($request->payment_method == 'VnPay') {

                $response = $this->vnPay($order->order_id);

                if ($response['code'] == '00') {
                    return redirect()->away($response['data']);
                }
            }

            Mail::to(auth()->user()->email)->send(new OrderShipped($order));

            Cart::destroy();

            if ($order->payment_method == 'VnPay' && $order->order_status == 'confirmed') {
                return redirect()->route('frontend.home')->with('success', 'Đơn hàng đã được thanh toán thành công');
            } else {
                return redirect()->route('frontend.home')->with('success', 'Đơn hàng đang được xử lí');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('frontend.home')->with('error', 'Đơn hàng không được thanh toán thành công');
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
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

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
            "vnp_ExpireDate" => $expire,
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
                            }

                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
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

        $order = Order::where('order_id', $orderId)->first();
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        // If Payment success
        // Update quantity product
        foreach ($orderDetails as $orderDetail) {
            ProductOptionValue::query()
                ->where('product_id', $orderDetail->product_id)
                ->where('color', $orderDetail->color)
                ->where('size', $orderDetail->size)
                ->decrement('quantity', $orderDetail->quantity);
        }

        Mail::to(auth()->user()->email)->send(new OrderShipped($order));

        Cart::destroy();

        return redirect()->route('frontend.home')->with('success', 'Đơn hàng đã được thanh toán thành công');

    }
}
