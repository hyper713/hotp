<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
use DB;
use Hash;
use Redirect;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
        $this->middleware('AdminEmailVerified');
    }

    public function index()
    {
        $admins=DB::table('admins')
                ->select('id','name','email','email_verified_at','active','created_at','updated_at')
                ->paginate(15);

        if(Auth::guard('admin-web')->user()->id==1){
            return view('admins.list')->with('admins', $admins);
        }
        else{
            return back();
        }
    }

    public function create()
    {
        if(Auth::guard('admin-web')->user()->id==1){
            return view('admins.create');
        }
        else{
            return back();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:admins',
        ]);

        if(Auth::guard('admin-web')->user()->id==1){
            $admin = new Admin;
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make(explode("@",$request->input('email'))[0]);
            $admin->save();
            return redirect(route('admins.index'))->with('success', "Admin Created Successfuly <NOTE> The password is the first part of the Email (The part befor '@')");
        }
        else{
            return back();
        }
    }

    public function edit($id)
    {
        if(Auth::guard('admin-web')->user()->id==$id){
            $admin = Admin::find($id);
            return view('admins.edit')->with('admin', $admin);
        }
        else{
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::guard('admin-web')->user()->id==$id){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                ]);
                
            $admin = Admin::find($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');

            $count1 = DB::table('admins')
                ->where('email',$admin->email)
                ->where('id','<>',$id)
                ->count();
            if( $count1>0){
                return Redirect::back()->with('error', 'Email already taken!')->withInput();
            }
            

            if($request->input('oldpassword') == null && $request->input('password') == null && $request->input('password_confirmation') == null ){
                $admin->save();
                return redirect('/dashboard')->with('success', 'Well Updated');
            }
            else{
                $this->validate($request, [
                    'oldpassword' => 'required',
                    'password' => 'required|confirmed',
                    ]);

                if(Hash::check($request->input('oldpassword') , $admin->password))
                {
                    $admin->password = Hash::make($request->input('password'));
                    $admin->save();
                    return redirect('/dashboard')->with('success', 'Well Updated');
                }
                else{
                    return redirect(route('admin.edit',$admin->id ))->with('error', "Old password is False");
                }
            }
        }
        else{
            return back();
        }
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if(Auth::guard('admin-web')->user()->id==1){
            $count1 = DB::table('categories')
                ->where('categories.admin_id','=',$id)
                ->count();
            
            $count2 = DB::table('providers')
                ->where('providers.admin_id','=',$id)
                ->count();
            $count3 = DB::table('groups')
                ->where('groups.admin_id','=',$id)
                ->count();
        
            if($count1>0 or $count2>0 or $count3>=0){
                return redirect(route('admins.index'))->with('error', "Can't delete this recod it's linked to ".$count1.' Categories(s)'.' And '.$count2.' Providers(s)'.' And '.$count3.' Groups(s)');
            }

            $admin->delete();
            return redirect(route('admins.index'))->with('success',' Well Deleted!');
        }
        else{
            return back();
        }
    }

    public function activate($id)
    {
        $admin = Admin::find($id);
        if($admin->active == 1)
        {
            $admin->active=0;
            $admin->save();
            return redirect(route('admins.index'))->with('success','Admin called "'.$admin->name.'" is Deactivated');
        }
        else
        {
            $admin->active=1;
            $admin->save();
            return redirect(route('admins.index'))->with('success','Admin called "'.$admin->name.'" is Activated');
        }
    }
}
