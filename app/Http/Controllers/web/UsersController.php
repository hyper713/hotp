<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $users=DB::table('users')
                ->select('name','email','email_verified_at','created_at','updated_at')
                ->paginate(15);
        return view('users.list')->with('users',$users);
    }
}
