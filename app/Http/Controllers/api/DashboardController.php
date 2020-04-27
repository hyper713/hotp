<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
    }

    public function index()
    {
        return response()->json(['auth id'=>Auth::guard('user-api')->user()->id]);
    }
}
