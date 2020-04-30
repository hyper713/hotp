<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Provider;
use App\Category;
use App\Group;
use Illuminate\Validation\Rule;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    public function index()
    {
        $groups=DB::table('groups')
                    ->join('admins','admins.id','=','groups.admin_id')
                    ->join('providers','providers.id_provider','=','groups.provider_id')
                    ->join('categories','categories.id_category','=','groups.category_id')
                    ->select('id_group','groups.name as grp_name','groups.link as grp_link','groups.created_at','groups.updated_at','admins.name as admn_name','providers.name as prov_name','categories.name as cat_name')
                    ->paginate(15);
        return view('groups.list')->with('groups',$groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers=Provider::all();
        $categories=Category::all();
        return view('groups.create')->with('providers',$providers)->with('categories',$categories);
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
            'name' => 'required|unique:groups',
            'link' => 'required|unique:groups',
            'provider' => 'required',
            'category' => 'required',
        ]);

        $elmt = new Group;
        $elmt->name=$request->input('name');
        $elmt->link=$request->input('link');
        $elmt->provider_id=$request->input('provider');
        $elmt->category_id=$request->input('category');
        $elmt->admin_id=Auth::guard('admin-web')->user()->id;
        $elmt->save();
        return redirect(route('groups.index'))->with('success', "Group Created Successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = DB::table('products')->where('group_id', $id)->paginate(15);
        $group=Group::find($id);

        return view('groups.products')->with('products',$products)->with('group',$group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $providers=Provider::all();
        $categories=Category::all();
        $group=Group::find($id);
        return view('groups.edit')->with('providers',$providers)->with('categories',$categories)->with('group',$group);
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
            'name' => ['required', Rule::unique('groups')->ignore($id, 'id_group')],
            'link' => ['required', Rule::unique('groups')->ignore($id, 'id_group')],
            'provider' => 'required',
            'category' => 'required',
        ]);

        $elmt = Group::find($id);
        $elmt->name=$request->input('name');
        $elmt->link=$request->input('link');
        $elmt->provider_id=$request->input('provider');
        $elmt->category_id=$request->input('category');
        $elmt->save();
        return redirect(route('groups.index'))->with('success', "Group Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        
        $group->delete();
        return redirect(route('groups.index'))->with('success', 'Well Deleted!');
    }
}
