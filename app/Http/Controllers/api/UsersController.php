<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use Hash;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
        $this->middleware('UserEmailVerified');
    }

    public function index()
    {
        $user=User::find(Auth::guard('user-api')->user()->id);
        $fav=DB::table('favourites')
                ->where('user_id',Auth::guard('user-api')->user()->id)
                ->count();

        $feed=DB::table('feedbacks')
                ->where('user_id',Auth::guard('user-api')->user()->id)
                ->count();

        return response()->json(['User'=>$user,'Favs'=>$fav, 'Feeds'=> $feed]);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['message'=>$validation->errors()->first()]);
        }
        else
        {
            $user=User::find(Auth::guard('user-api')->user()->id);
            $user->name=$request->name;
            $user->save();

            return response()->json(['message'=>'user updated successfully']);
        }
    }

    public function pass(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json(['message'=>$validation->errors()->first()]);
        }
        else
        {
            if(strcmp($request->password_confirmation, $request->password)==0)
            {
                $user=User::find(Auth::guard('user-api')->user()->id);
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['message'=>'password updated successfully']);
            }
            else{
                return response()->json(['message'=>'non matching passwords']);
            }
        }
    }
}
