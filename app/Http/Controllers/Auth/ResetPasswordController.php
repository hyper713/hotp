<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Mail\AdminResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Admin;
use Hash;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.reset');
    }

    public function send(Request $request)
    {
        $admin = Admin::where('email',$request->email) -> first();
        if (!isset($admin)) {
            return back()->with('error','You have entered invalid Email');
        } else {
            $password= Str::random(8);

            $data=array(
                'name'=> $admin->name,
                'password'=> $password,
            );
    
            Mail::to($admin->email)->send(new AdminResetPassword($data));
            $admin->password = Hash::make($password);
            $admin->save();
            return back()->with('success','A fresh Password has been sent to your email address.');
        }
        

    }
}
