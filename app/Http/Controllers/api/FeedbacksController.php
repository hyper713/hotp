<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Feedback;
use Auth;
use DB;

class FeedbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user-api');
        $this->middleware('UserEmailVerified');
    }

    public function index()
    {
        $feedbacks=DB::table('feedbacks')
                        ->where('user_id',Auth::guard('user-api')->user()->id)
                        ->get();
        
        return response()->json(['feedbacks'=>$feedbacks]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'subject' => 'required|string|max:50',
            'text' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        else
        {
            $feed = new Feedback;
            $feed->user_id= Auth::guard('user-api')->user()->id;
            $feed->subject=$request->subject;
            $feed->text=$request->text;
            $feed->save();
            return response()->json(['success'=>'feedback created successfully']);
        }
    }
}
