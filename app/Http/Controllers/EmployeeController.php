<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function employee()
    {  
         return view('Admin.Employee.index');
    }
    public function employeelist(Request $request)
    {
      if ($request->ajax()) {
         //$data = User::select('*');
         $data=User::where('roles_id',2)->latest()->get();
         $user = User::latest()->get();
         return DataTables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
    
                        $btn = '<a href="'.route('viewdata',$row->id).'"  class=" btn btn-info btn-sm m-1">View</a>';
                        $btn = $btn.'<a href="'.route('edit',$row->id).'" class="edit btn btn-primary btn-sm m-1">Edit</a>';
                        if($row->status == 1)
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class=" btn btn-success btn-sm active">Active</a>';
                        }else
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class=" btn btn-danger btn-sm inactive">Inactive</a>';
                        }
                       
                         return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
     }
     
    }  
    public function addemployee()
    {
       return view('Admin.Employee.add');
    }
    public function add(UserStoreRequest  $request)
    {
         $user=new User;
         $user->name=$request->name;
         $user->email=$request->email;
         $user->password= Hash::make($request->password);
         $user->mobile_number=$request->mobile_number;
         $user->dob=$request->dob;
         $user->joining_date=$request->joining_date;
         $user->gender=$request->gender;
         $user->qualification=$request->qualification;
         $user->address=$request->address;
         $user->save();
         return redirect('employee');
    }
    public function status(Request $request,$id)
    {
       $user = User::find($id);
       $user->status=0;
        $user->save();
        return redirect('employee');
    }
    public function viewdata($id)
    {
      $datas=User::find($id);
      return view('Admin.Employee.view',compact('datas'));
    }
    public function edit($id)
    {
      $datas=User::find($id);
      return view('Admin.Employee.edit',compact('datas'));
    }
    public function update(Request $request,$id)
    {
      $updatedata=User::find($id);
      $updatedata->name=$request->name;
      $updatedata->email=$request->email;
      $updatedata->password= Hash::make($request->password);
      $updatedata->mobile_number=$request->mobile_number;
      $updatedata->dob=$request->dob;
      $updatedata->joining_date=$request->joining_date;
      $updatedata->gender=$request->gender;
      $updatedata->qualification=$request->qualification;
      $updatedata->address=$request->address;
      $updatedata->update();
      return redirect('employee');
    }
}
