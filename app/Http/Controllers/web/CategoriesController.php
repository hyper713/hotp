<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use Redirect;
use DB;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $categories=DB::table('categories')
                    ->join('admins','admins.id','=','categories.admin_id')
                    ->select('id_category','categories.name as cat_name','categories.created_at','categories.updated_at','admins.name as admn_name')
                    ->paginate(15);
        return view('categories.list')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        $elmt = new Category;
        $elmt->name=$request->input('name');
        $elmt->admin_id=Auth::guard('admin-web')->user()->id;
        $elmt->save();
        return redirect(route('categories.index'))->with('success', "Category Created Successfuly");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = DB::table('groups')->where('category_id', $id)->pluck('id_group');
        $products = DB::table('products')->wherein('group_id', $groups)->paginate(40);
        $category=Category::find($id);

        return view('categories.products')->with('products',$products)->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('categories')->ignore($id, 'id_category')],
        ]);
        $elmt = Category::find($id);
        $elmt->name=$request->input('name');
        $elmt->save();
        return redirect(route('categories.index'))->with('success', "Category Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count1 = DB::table('groups')
        ->where('groups.category_id','=',$id)
        ->count();
        
        $count2 = DB::table('votes')
        ->where('votes.category_id','=',$id)
        ->count();
        
        if($count1>0 OR $count2>0){
            return redirect(route('categories.index'))->with('error', "Can't delete this recod it's linked to ".$count1.' Groups(s)'.' And '.$count2.' Votes(s)');
        }
        
        $category = Category::find($id);
        
        $category->delete();
        return redirect(route('categories.index'))->with('success', 'Well Deleted!');
    }

}
