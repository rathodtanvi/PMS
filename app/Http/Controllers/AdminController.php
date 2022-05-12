<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Auth;
use Hash;
use DataTables;


class AdminController extends Controller
{
    public function home()
    {
       return view('Admin.home'); 
    }
    public function myprofile()
    {
        return view('Admin.Profile.index'); 
    }
 
    public function changepassword(Request $request)
    {
             if($request->input('current_password')=="" | $request->input('password')=="" | $request->input('confirm_password')=="")
             {
                return response()->json(['fail'=>true]);
             }
             elseif(!\Hash::check($request->input('current_password'),Auth::user()->password))
             {
               return response()->json(['match'=>true]);
             }
             elseif($request->input('password') !=  $request->input('confirm_password'))
             {
               return response()->json(['equl'=>true]);
             }
             else
             {
                $admin=Auth::user();
                $admin->password = Hash::make($request->input('password'));
                $admin->save();
                return response()->json(['success'=>true]);
             }
           
    }

    
}
