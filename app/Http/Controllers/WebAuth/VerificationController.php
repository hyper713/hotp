<?php

namespace App\Http\Controllers\WebAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Mail\AdminVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Auth;
use App\AdminCode;
use Hash;
use DB;
use App\Admin;
class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }

    public function index()
    {
        if(Auth::guard('admin-web')->user()->hasVerifiedEmail()){
            return back();
        }
        return view('auth.verify');
    }

    
    public function send()
    {
        if(Auth::guard('admin-web')->user()->hasVerifiedEmail()){
            return back();
        }

        $code= Str::random(4);
        $address = Auth::guard('admin-web')->user()->email;

        $data=array(
            'name'=> Auth::guard('admin-web')->user()->name,
            'code'=> $code,
        );

        Mail::to($address)->send(new AdminVerify($data));

        $elm=new AdminCode;
        $elm->admin_id=Auth::guard('admin-web')->user()->id;
        $elm->code=$code;
        $elm->save();
        return back()->with('success','A fresh email has been sent to your email address.');

    }

    public function verify(Request $request)
    {
        if(Auth::guard('admin-web')->user()->hasVerifiedEmail()){
            return back();
        }
        
        $sent_code = DB::table('admin_code')
                    ->where('admin_id',Auth::guard('admin-web')->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

        if(strcmp($request->code , $sent_code->code)==0)
        {
            $admin = Admin::find(Auth::guard('admin-web')->user()->id);
            $admin->email_verified_at=date('Y-m-d H:i:s');
            $admin->save();
            return redirect('dashboard');
        }
        else
        {
            return back()->with('error','You have entered invalid code');
        }
    }
}
