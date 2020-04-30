<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Provider;
use App\Category;
use App\Group;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('products.list')->with('categories',$categories)->with('providers',$providers);
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $providers = Provider::all();

        $input_category = $request->input('category');
        $input_provider = $request->input('provider');

        $group = DB::table('groups')->where('category_id', $input_category)->where('provider_id', $input_provider)->value('id_group');

        $products = DB::table('products')->where('group_id', $group)->get();

        return view('products.list')->with('categories',$categories)->with('providers',$providers)->with('input_category',$input_category)
                ->with('input_provider',$input_provider)->with('products',$products);
    }
}
