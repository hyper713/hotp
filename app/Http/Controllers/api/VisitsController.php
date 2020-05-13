<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class VisitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
        $this->middleware('UserEmailVerified');
    }

    public function index(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        else
        {
            $elm=Product::find($request->product_id);
            $elm->visits = $elm->visits +1;
            $elm->save();
            return response()->json(['success'=>'visit added successfully']);
        }
    }
}
