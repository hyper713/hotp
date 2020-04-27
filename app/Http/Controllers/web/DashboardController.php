<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }

    public function index()
    {
        if(!Auth::guard('admin-web')->user()->hasVerifiedEmail()){
            return redirect('verify');
        }
        return view('dashboard');
    }
}
