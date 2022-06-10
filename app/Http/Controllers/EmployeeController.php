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
    public function index()
    {  
        return view('Employee.index');
    }
    public function create()
    {
      return view('Employee.add');
    }
    public function store(UserStoreRequest  $request)
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
        return redirect('employee')->with('status', 'Successfully Inserted Employee Deatils');
    }
    public function show($id)
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
      return redirect('employee')->with('status', 'Successfully Update Employee Deatils');
    }
    public function getdata(Request $request)
    {
      if ($request->ajax()) {
         //$data = User::select('*');
          $data=User::where('roles_id',2)->orWhere('roles_id',3)->latest()->get();
          //$user = User::latest()->get();
          return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
    
                        $btn = '<a href="'.route('employee.show',$row->id).'"  class="fa fa-eye btn btn-warning btn-sm m-1"></a>';
                        $btn = $btn.'<a href="'.route('employee.edit',$row->id).'" class="fa fa-edit edit btn btn-primary btn-sm m-1"></a>';
                        if($row->status == 1)
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class="fa fa-check btn btn-success btn-sm active" data-toggle="tooltip" title="Active!"></a> ';
                        }else
                        {
                        $btn = $btn.'<a href="'.route('status',$row->id).'" class="fa fa-close btn btn-danger btn-sm inactive mr-1" data-toggle="tooltip" title="inactive!"></a>';
                        }
                        if($row->roles_id == 2)
                        {
                        $btn = $btn.'<a href="'.route('changerole',$row->id).'" class="fa fa-users btn btn-secondary btn-sm active  mt-1" data-toggle="tooltip" title="Remove Team Leader!"></a>';
                        }else
                        {
                        $btn = $btn.'<a href="'.route('changerole',$row->id).'" class="fa fa-user btn btn-secondary btn-sm inactive mt-1"  data-toggle="tooltip" title="Create Team Leader!"></a>';
                        }
                        return $btn;
                })
                ->rawColumns(['action'])
              
                ->make(true);
      }
      
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
        if($user->status == 0)
        {
          return redirect('employee')->with('status', ' InActive Employee!');
        }
        else
        {
          return redirect('employee')->with('status', ' Active Employee!');
        
        }
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
        if($user->roles_id == 3)
        {
          return redirect('employee')->with('status', 'Successfully Remove From Teame Leader!');
        }
        else
        {
          return redirect('employee')->with('status', 'Successfully  Created Teame Leader!');
        
        }
       
    }
   
    
}
