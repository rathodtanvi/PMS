<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Auth;
use Hash;
use DataTables;

class HomeController extends Controller
{
   public function index()
    {   
        return redirect('/home');
    }

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
       $datas=User::where('id',Auth::id())->first(); 
        return view('Profile.index',compact('datas')); 
    }
 
   public function updateprofile(Request $request,$id)
    { 
       
       $updatedata=User::find($id);
      $updatedata->name=$request->name;
      $updatedata->email=$request->email;
      $updatedata->mobile_number=$request->mobile_number;
      $updatedata->dob=$request->dob;
      $updatedata->joining_date=$request->joining_date;
      $updatedata->gender=$request->gender;
      $updatedata->qualification=$request->qualification;
      $updatedata->address=$request->address;
      $updatedata->update();
      return redirect()->back();
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
