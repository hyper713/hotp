<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin-web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::guard('admin-web')->user()->active==1) {
                return redirect('dashboard');
            } else {
                Auth::guard('admin-web')->logout();
                return back()->with('error', 'Your account is not activated')->withInput();
            }
        }
        else
        {
            return back()->with('error','Opps! invalid credentials')->withInput();
        }
        
    }

    public function logout()
    {
        Auth::guard('admin-web')->logout();
        return redirect('login');
    }
}
