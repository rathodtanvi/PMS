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
       $employee=User::all();
       return view('Admin.home',compact('employee')); 
    }
    public function employee_list(Request $request)
    {
      if ($request->ajax()) {
        $data=User::all();
        return DataTables::of($data)
               ->addColumn('attendance_duration',function(User $attendance_duration){
                return "00";
               })
               ->addColumn('work_duration',function(User $work_duration){
                  return "00";
               })
                ->rawColumns(['action'])
                ->make(true);
    }
      // return view('User.daily_work_entry');
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
