<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Provider;
use App\Group;
use App\Feedback;
use App\Admin;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $var = array('products' => Product::count(),
        'categories' => Category::count(),
        'providers' => Provider::count(),
        'groups' => Group::count(),
        'feedbacks' => Feedback::count(),
        'visits' => Product::sum('visits'),
        'users' => User::count(),
        'admins' => Admin::count(),
        );

        return view('dashboard')->with('var',$var);
    }
}
