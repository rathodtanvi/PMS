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
        return view('Employee.index');
    }
    public function employeelist(Request $request)
    {
      if ($request->ajax()) {
         //$data = User::select('*');
          $data=User::where('roles_id',2)->orWhere('roles_id',3)->latest()->get();
          $user = User::latest()->get();
          return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
    
                        $btn = '<a href="'.route('viewdata',$row->id).'"  class="fa fa-eye btn btn-warning btn-sm m-1"></a>';
                        $btn = $btn.'<a href="'.route('edit',$row->id).'" class="fa fa-edit edit btn btn-primary btn-sm m-1"></a>';
                        if($row->status == 1)
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class="fa fa-check btn btn-success btn-sm active"></a> ';
                        }else
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class="fa fa-close btn btn-danger btn-sm inactive mr-1"></a>';
                        }
                        if($row->roles_id == 2)
                        {
                        $btn = $btn.'<a href="'.route('changerole',$row->id).'" class="fa fa-users btn btn-secondary btn-sm active  mt-1"></a>';
                        }else
                        {
                        $btn = $btn.'<a href="'.route('changerole',$row->id).'" class="fa fa-user btn btn-secondary btn-sm inactive mt-1"></a>';
                        }
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
      }
      
    }  
    public function addemployee()
    {
      return view('Employee.add');
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
      if( $user->status == 0)
      {
        $user->status=1;
      }
      else
      {
        $user->status=0;
      }
        $user->save();
        return redirect('employee');
    }
    public function changerole(Request $request,$id)
    {
      $user = User::find($id);
      if($user->roles_id == 3)
      {
        $user->roles_id=2;
      }
      else
      {
        $user->roles_id=3;
      }
        $user->save();
        return redirect('employee');
    }
    public function viewdata($id)
    {
      $datas=User::find($id);
      return view('Employee.view',compact('datas'));
    }
    public function edit($id)
    {
      $datas=User::find($id);
      return view('Employee.edit',compact('datas'));
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
