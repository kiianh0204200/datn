<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $data = $request->safe()->only('email', 'password', 'remember_token');

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember_token'] ?? 0)) {
            $request->session()->regenerate();

            toastr()->success('Welcome back, ' . auth()->user()->name);
            return redirect(route('admin.home'));
        }

        toastr()->error(__('backend.The provided credentials do not match our records.'));
        return back();
    }
}
