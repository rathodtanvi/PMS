<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DailyWorkEntry;
use App\Models\Leave;
use Auth;
use Hash;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    public function userhome()
    {
        $datas=User::where('id',Auth::id())->first();
      //  $datas=User::all();
        return view('User.userhome',compact('datas'));
    }
    public function userprofile()
    {
        return view('User.Profile.index'); 
    }
    public function userchangepassword(Request $request)
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
             else{
                $admin=Auth::user();
                $admin->password = Hash::make($request->input('password'));
                $admin->save();
                return response()->json(['success'=>true]);
             }
           
    }
}
