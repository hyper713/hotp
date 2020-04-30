<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feedback;
use DB;

class FeedbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $feedbacks=Feedback::all();
        $feedbacks=DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.user_id')
                ->select('feedbacks.subject','feedbacks.text','feedbacks.created_at','feedbacks.updated_at', 'users.name')
                ->orderByDesc('updated_at')
                ->paginate(15);

        return view('feedbacks.list')->with('feedbacks',$feedbacks);
    }
}
