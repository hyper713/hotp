<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoadController extends Controller
{
        public function index()
        {
                $product_visit=DB::table('products')
                        ->orderBy('visits', 'desc')
                        ->take(20)
                        ->get();
                
                $product_best=DB::table('products')
                        ->where('best', 1)
                        ->take(20)
                        ->get();
                
                $products=DB::table('products')
                        ->get();

                $groups=DB::table('groups')
                        ->select('id_group','category_id','provider_id','name')
                        ->get();

                $categories=DB::table('categories')
                        ->select('id_category','name')
                        ->get();

                $providers=DB::table('providers')
                        ->select('id_provider','name')
                        ->get();

                return response()->json(['products_by_visits'=>$product_visit,'products_by_best'=>$product_best,'products_all'=>$products,'groups_all'=>$groups,'categories_all'=>$categories,'providers_all'=>$providers]);
        }
}

