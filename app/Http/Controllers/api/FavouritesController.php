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
            return response()->json(['message'=>$validation->errors()->first()]);
        }
        else{
            $count=DB::table('favourites')
                    ->where('user_id',Auth::guard('user-api')->user()->id)
                    ->where('product_id',$request->product_id)
                    ->count();
    
            if ($count>0) {
                return response()->json(['message'=>'favourit already exists']);
            } 
            else{
                $product=Product::find($request->product_id);
                
                if (empty($product)) {
                    return response()->json(['message'=>'bad product']);
                }
                else{
                    $elm=new Favourite;
            
                    $elm->user_id=Auth::guard('user-api')->user()->id;
                    $elm->product_id=$request->product_id;
                    $elm->name=$product->name;
                    $elm->image=$product->image;
                    $elm->price=$product->price;
                    $elm->link=$product->link;
                    $elm->available=1;
                    $elm->save();
                    
                    return response()->json(['message'=>'favourite created successfully']);
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
            return response()->json(['message'=>$validation->errors()->first()]);
        }
        else{
            $elm=Favourite::find($request->favourite_id);
    
            if (empty($elm)) {
                return response()->json(['message'=>'bad Favourite']);
            }
            else{
                if ($elm->user_id == Auth::guard('user-api')->user()->id) {
                    $elm->delete();
                    return response()->json(['message'=>'favourite deleted successfully']);
                }
                else{
                    return response()->json(['message'=>'not allowed']);
                }
            }
        }
    }
}
