<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Provider;
use Auth;
use Illuminate\Validation\Rule;


class ProvidersController extends Controller
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
        $providers=DB::table('providers')
                    ->join('admins','admins.id','=','providers.admin_id')
                    ->select('id_provider','providers.name as prov_name','providers.link','providers.created_at','providers.updated_at','admins.name as admn_name')
                    ->paginate(15);
        return view('providers.list')->with('providers',$providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
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
            'name' => 'required|unique:providers',
            'link' => 'required',
        ]);
        $elmt = new Provider;
        $elmt->name=$request->input('name');
        $elmt->link=$request->input('link');
        $elmt->admin_id=Auth::guard('admin-web')->user()->id;
        $elmt->save();
        return redirect(route('providers.index'))->with('success', "Provider Created Successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = DB::table('groups')->where('provider_id', $id)->pluck('id_group');
        $products = DB::table('products')->wherein('group_id', $groups)->paginate(15);
        $provider=provider::find($id);

        return view('providers.products')->with('products',$products)->with('provider',$provider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('providers.edit')->with('provider',$provider);
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
            'name' => ['required', Rule::unique('providers')->ignore($id, 'id_provider')],
            'link' => 'required',
        ]);
        $elmt = Provider::find($id);
        $elmt->name=$request->input('name');
        $elmt->link=$request->input('link');
        $elmt->save();
        return redirect(route('providers.index'))->with('success', "Provider Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        
        $provider->delete();
        return redirect(route('providers.index'))->with('success',' Well Deleted!');
    }
}
