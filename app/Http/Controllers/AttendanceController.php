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
    public function index(Request $request)
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
        $duration = Attendance::where('user_id','=',Auth::user()->id)->where('attendance_date','=',$currentdate)->get();
        
        $attendance = [];
        foreach($duration as $row)
        {
            if($row['in_entry'] != Null)
            {
                
                if($row['out_entry'] != Null)
                {
                    $start = new DateTime(date("H:i:s", strtotime($row['in_entry'])));
                    $end =  new DateTime(date("H:i:s", strtotime($row['out_entry'])));
                    $interval = $start->diff($end);
                }
                else
                {
                    $start = new DateTime(date("H:i:s", strtotime($row['in_entry'])));
                    $end =  new DateTime(date("H:i:s", strtotime(Carbon::now('Asia/Kolkata'))));
                    $interval = $start->diff($end);
                }
            }
    
            $attendance[] = $interval->format('%h').":".$interval->format('%i').":".$interval->format('%s');

        }
    
        echo $this->AddPlayTime($attendance);
        
    }

    public function AddPlayTime($times) {
        $seconds  = 0; //declare minutes either it gives Notice: Undefined variable

        // loop throught all the times
        foreach ($times as $time) {
            list($hour, $minute , $second) = explode(':', $time);
            $seconds  += $hour * 3600;
            $seconds  += $minute * 60;
            $seconds  += $second ;
        }
    
        $hours = floor($seconds  / 3600);
        $seconds  -= $hours * 3600;

        $minutes  = floor($seconds/60);
        $seconds -= $minutes * 60;
        
        // returns the time already formatted
        return json_encode(sprintf('%02d:%02d:%02d', $hours, $minutes , $seconds)); 
        
    }
}
