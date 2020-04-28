<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\UserVerify;
use Illuminate\Support\Facades\Mail;
use App\UserCode;
use Auth;
use DB;
use App\User;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
    }

    public function send()
    {
        if(Auth::guard('user-api')->user()->hasVerifiedEmail()){
            return response()->json(['Error'=>'The email is Already verified']);
        }

        $code= Str::random(4);
        $address = Auth::guard('user-api')->user()->email;

        $data=array(
            'name'=> Auth::guard('user-api')->user()->name,
            'code'=> $code,
        );

        Mail::to($address)->send(new UserVerify($data));

        $elm=new UserCode;
        $elm->user_id=Auth::guard('user-api')->user()->id;
        $elm->code=$code;
        $elm->created_at=date('Y-m-d H:i:s');
        $elm->save();
        return response()->json(['success'=>'A fresh email has been sent to your email address.']);
    }

    public function verify(Request $request)
    {
        if(Auth::guard('user-api')->user()->hasVerifiedEmail()){
            return response()->json(['Error'=>'The email is Already verified']);
        }

        $sent_code = DB::table('user_code')
                    ->where('user_id',Auth::guard('user-api')->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
        
        if(!isset($sent_code))
        {
            return response()->json(['Error'=>'Not found, Request another verification email']);
        }
        
        if(strcmp($request->code , $sent_code->code)==0)
        {
            $user = User::find(Auth::guard('user-api')->user()->id);
            $user->email_verified_at=date('Y-m-d H:i:s');
            $user->save();
            return response()->json(['Success'=>'Email verified successfully']);
        }
        else
        {
            return response()->json(['Error'=>'You have entered invalid code']);
        }
    }
}
