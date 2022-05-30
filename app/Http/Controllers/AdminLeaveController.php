<?php

namespace App\Http\Controllers;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminLeaveController extends Controller
{
    public function all_leave()
    {
        return view('Leave.index');
    }

    public function all_leavelist(Request $request)
    {
      if ($request->ajax()) {
        $data=Leave::latest()->get();
        //$work = Leave::latest()->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                  $btn = '<a href="" class=" btn btn-primary btn-sm m-1">Pending</a>';
                  $btn = $btn.'<a href="'.route('all_leavestatus',$row->id).'"  class=" btn btn-warning btn-sm m-1">Approve</a>';
                  $btn = $btn.'<a href=""  class=" btn btn-danger btn-sm m-1">Decline</a>';

                    //    if($row->leave_status == 1)
                    //    {
                    //     $btn = $btn.'<a href="'.route('all_leavestatus',$row->id).'"  class=" btn btn-warning btn-sm m-1">Approve</a>';
                    //    }
                    //    else
                    //    {
                    //    $btn = $btn.'<a href="'.route('all_leavestatus',$row->id).'"  class=" btn btn-danger btn-sm m-1">Decline</a>';
                    //    }
                        $btn =$btn.'<a href="'.route('all_leaveview',$row->id).'" class="edit btn btn-success btn-sm m-1">view</a>';
                        return $btn;
                })
                ->addColumn('created_at',function($request){
                return  $request->created_at->format('Y-m-d');
                })
                ->addColumn('message',function(Leave $msg){
                return Strip_tags($msg->message);
                })
                ->addColumn('name',function(Leave $name){
                  return  $name->users->name;
                })
                ->addColumn('fdate_start',function($request){
                      $firstdate=Carbon::parse($request->date_start);
                      $seconddate=Carbon::parse($request->date_end);
                      $diff =$firstdate->diffInDays($seconddate);
                      if($diff == 0)
                      return 1;
                      elseif($request->date_end == "")
                      return 1;
                      else
                      return $diff;
                })
                ->addColumn('leave_type',function(Leave $leave_type){
                      if($leave_type->leave_type == 1)
                        return "Half Day leave";
                        if($leave_type->leave_type == 2)
                        return "Full Day leave";
                        if($leave_type->leave_type == 3)
                        return "Multipal Day leave";
                      
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function all_leavestatus(Request $request,$id)
    {
      $user = Leave::find($id);
        $user->leave_status=1;
        $user->save();
        return redirect('all_leave')->with('status', 'Approved Leave!');;
    }
    public function all_leaveview($id)
    {
        $datas= Leave::find($id);
        return view('Admin.Leave.view',compact('datas'));
    }
}
