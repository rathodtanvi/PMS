<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function Attendance(Request $request)
    {
        $todate = Carbon::now()->format('Y-m-d');
        
        $attendance  = Attendance::where('user_id','=',Auth::user()->id)->where('attendance_date',"=",$todate)->latest()->get();
        $getlatest = Attendance::where("user_id",'=',Auth::user()->id)->latest()->first();
        
        return view('Attendance.index',compact('attendance','getlatest'));
    }

    public function AddAttendance(Request $request)
    {
        $currenttime = Carbon::now('Asia/Kolkata')->format('h:i A');
        $attend = new Attendance;
        $attend->user_id = Auth::user()->id;
        $attend->in_entry = $currenttime;
        $attend->out_entry = null;
        $attend->attendance_date = Carbon::now()->format('Y-m-d');
        //dd($attend);
        $attend->save();

        return response()->json(['data',$currenttime]);
    }

    public function OutAttendance()
    {
        $strtime = $_GET['stime'];
        $stime = trim($strtime);
        $uid =  Auth::user()->id;
        
        $currenttime = Carbon::now('Asia/Kolkata')->format('h:i A');

        $out = DB::table("attendace")->where("user_id","=",$uid)->where("in_entry","=",$stime)->update(["out_entry" => $currenttime]);
        
        return response()->json(['data'=>$currenttime]);
    }

    public function WorkHours()
    {
        $currentdate = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $duration = Attendance::where('user_id','=',Auth::user()->id)->where('attendance_date','=',$currentdate)->latest()->get();
        //$duration1 = Attendance::where('user_id','=',Auth::user()->id)->where('attendance_date','=',$currentdate)->first();
        
        foreach($duration as $row)
        {
            if($row['in_entry'] != Null && $row['out_entry'] != Null)
            {
                
                $start = str_replace(" AM",":00",$row['in_entry']);
                $strconv = new DateTime($start);

                $end = str_replace(" AM",":00",$row['out_entry']);
                $endconv = new DateTime($end);
                
                $time_diff = $endconv->diff($strconv);
                $htime[] = $time_diff->format('%H');
                $mtime[] = $time_diff->format('%I');
                $stime[] = $time_diff->format('%S');
            }
            else
            {
                $start = str_replace(" AM",":00",$row['in_entry']);
                $strconv = new DateTime($start);
                
                $end = Carbon::now('Asia/Kolkata');
                $endconv =  new DateTime($end);
                
                
                $time_diff = $endconv->diff($strconv);
                
                $htime[] = $time_diff->format('%H');
                $mtime[] = $time_diff->format('%I');
                $stime[] = $time_diff->format('%S');
                
            }
            
        } 
        
        $h_sum = array_sum($htime);
        $m_sum = array_sum($mtime);
        $s_sum = array_sum($stime);
        
        return response()->json($h_sum.":".$m_sum.":".$s_sum);
    }
}
