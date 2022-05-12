<?php

namespace App\Http\Controllers;
use App\Models\Leave;
use App\Models\User;
use Auth;
use Hash;
use DataTables;
use App\Http\Requests\LeaveRequest;
use Carbon\Carbon;


use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function leave()
    {
        return view('User.Leave.index');
    }
    public function leavelist(Request $request)
    {
      if ($request->ajax()) {
        $data=Leave::where('user_id',Auth::id())->get();
        //$work = Leave::latest()->get();
        return DataTables::of($data)
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('leavestatus',$row->id).'"  class=" btn btn-primary btn-sm m-1">Pending</a>';
                       $btn =$btn.'<a href="'.route('leaveview',$row->id).'" class="edit btn btn-success btn-sm m-1">view</a>';
                        return $btn;
               })
               ->addColumn('created_at',function($request){
                return  $request->created_at->format('Y-m-d');
               })
               ->addColumn('message',function(Leave $msg){
                return Strip_tags($msg->message);
               })
               ->addColumn('name',function(Leave  $name){
                 return  $name=Auth::user()->name;
               })
               ->addColumn('fdate_start',function($request){
                     $firstdate=Carbon::parse($request->date_start);
                     $seconddate=Carbon::parse($request->date_end);
                     $diff=$firstdate->diffInDays($seconddate);
                     if($diff == 0)
                     return 1;
                     else
                     return $diff;
                    // return $firstdate->diffInDays($seconddate);
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
    public function addleave()
    {
         return view('User.Leave.add');
    }
    public function inleave(Request $request)
    {
        $leave=new Leave();
        $leave->user_id=Auth::id();
        $leave->leave_type = $request->leave_type;
        $leave->half_leave_type = $request->half_leave_type;
        $leave->subject=$request->subject;
        $leave->date_start=$request->date_start;
        $leave->date_end=$request->date_end;
        $leave->leave_status=$request->leave_status ?? 0;
        $leave->message=$request->message;
        $leave->approve=$request->approve ?? 0;
        $leave->save();
        return redirect('leave');
    }
    public function leaveview($id)
    {
       $datas= Leave::find($id);
       return view('User.Leave.view',compact('datas'));
    }

    public function all_leave()
    {
        return view('Admin.Leave.index');
    }


    public function all_leavelist(Request $request)
    {
      if ($request->ajax()) {
        $data=Leave::all();
        //$work = Leave::latest()->get();
        return DataTables::of($data)
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('leavestatus',$row->id).'"  class=" btn btn-primary btn-sm m-1">Pending</a>';
                       $btn =$btn.'<a href="'.route('leaveview',$row->id).'" class="edit btn btn-success btn-sm m-1">view</a>';
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
}
