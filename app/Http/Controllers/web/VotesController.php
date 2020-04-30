<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Votes;
use App\Category;
use App\User;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $votes_categories=DB::table('votes')
                ->select('category_id',DB::raw('count(*) as number'))
                ->groupBy('category_id')
                ->orderBy('number','desc')
                ->get();

        $categories=Category::all();

        $votes_users=DB::table('votes')
                ->select('user_id',DB::raw('count(*) as number'))
                ->groupBy('user_id')
                ->orderBy('number','desc')
                ->get();

        $users=User::all('id','name');

        
        return view('votes.list')->with('votes_categories',$votes_categories)->with('categories',$categories)->with('votes_users',$votes_users)->with('users',$users);
    }
}
