<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderByDesc('id')->paginate(10);
        return view('frontend.pages.account', compact('orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
        ]);

        $user = User::find(auth()->user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->address_2 = $request->input('address_2');
        $user->save();

        return redirect()->back()->with('success', __('frontend.Account details updated successfully.'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('orderItems')->find($id);
        if ($order) {
            return view('frontend.pages.order-detail', compact('order'));
        } else {
            return redirect()->back()->with('error', __('frontend.Order not found.'));
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
        ]);

    public function orderCancel($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->order_status = 'cancelled';
            $order->save();
            return redirect()->back()->with('success', __('frontend.Order has been cancelled successfully.'));
        } else {
            return redirect()->back()->with('error', __('frontend.Order not found.'));
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::query()->where('id', auth()->user()->id)->firstOrFail();

        if (Hash::check($data['password'], $user->password)) {
            $user->update([
                'password' => $data['new_password'],
            ]);

            return response()->json(['success' => true, 'message' => 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Mật khẩu cũ không đúng.']);
        }
    }
}
