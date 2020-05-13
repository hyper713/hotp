<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        else
        {
            $user = User::where('email', $request->email)->first();

            if(Hash::check($request->password, $user->password))
            {
                return response()->json($user->only('name','email','api_token'));
            }
            else
            {
                return response()->json(['error'=>'wrong login credentials']);
            }
        }
    }
}
