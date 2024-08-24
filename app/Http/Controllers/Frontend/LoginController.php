<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'string']
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
<<<<<<< HEAD
=======
            toastr()->success('Đăng nhập thành công!');
>>>>>>> 2a7a1bea2d3cf88d390af0aefb42db3259e7a90b
            return redirect()->route('frontend.home');
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', __('frontend.Invalid credentials'));
    }

    /**
     * Logout Users.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('frontend.login'))->with('success', __('frontend.You have been logged out.'));
    }
<<<<<<< HEAD
=======
    public function logoutt(Request $request)
    {
        Auth::logoutt();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('frontend.login'))->with('success', __('frontend.You have been logged out.'));
    }
>>>>>>> 2a7a1bea2d3cf88d390af0aefb42db3259e7a90b
}
