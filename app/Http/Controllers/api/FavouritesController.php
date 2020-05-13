<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Favourite;
use Auth;
use DB;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
        $this->middleware('UserEmailVerified');
    }

    public function index()
    {
        $favourites=DB::table('favourites')
                        ->where('user_id',Auth::guard('user-api')->user()->id)
                        ->get();
        
        return response()->json(['favourits'=>$favourites]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        else
        {
            $count=DB::table('favourites')
                    ->where('product_id',$request->product_id)
                    ->count();
    
            if ($count>0) {
                return response()->json(['error'=>'favourit already exists']);
            } else {
                $product=Product::find($request->product_id);
    
                if (empty($product)) {
                    return response()->json(['error'=>'bad product']);
                } else {
                    $elm=new Favourite;
            
                    $elm->user_id=Auth::guard('user-api')->user()->id;
                    $elm->product_id=$product->id_product;
                    $elm->name=$product->name;
                    $elm->image=$product->image;
                    $elm->price=$product->price;
                    $elm->link=$product->link;
                    $elm->available=1;
                    $elm->save();
                    
                    return response()->json(['success'=>'favourite created successfully']);
                }
            }
        }
    }

    public function destroy(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'favourite_id' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        else
        {
            $elm=Favourite::find($request->favourite_id);
    
            if (empty($elm)) {
                return response()->json(['error'=>'bad Favourite']);
            } else {
                if ($elm->user_id == Auth::guard('user-api')->user()->id) {
                    $elm->delete();
                    return response()->json(['success'=>'favourite deleted successfully']);
                } else {
                    return response()->json(['error'=>'not allowed']);
                }
            }
        }
    }
}
