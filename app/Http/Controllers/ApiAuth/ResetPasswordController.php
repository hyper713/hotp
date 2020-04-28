<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\UserResetPassword;
use Illuminate\Support\Facades\Mail;
use App\User;
use Hash;


class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function send(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }

        $user = User::where('email',$request->email)->first();
        $password= Str::random(8);

        $data=array(
            'name'=> $user->name,
            'password'=> $password,
        );

        Mail::to($request->email)->send(new UserResetPassword($data));
        $user->password = Hash::make($password);
        $user->save();
        return response()->json(['success'=>'A fresh Password has been sent to your email address.']);
    }

}
