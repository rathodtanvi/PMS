<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function Attendance()
    {
        $attendance  = Attendance::where('user_id','=',Auth::user()->id)->get();
        return view('Client.Attendance.index',compact('attendance'));
    }

    public function AddAttendance(Request $request)
    {
        $currenttime = Carbon::now('Asia/Kolkata')->format('h:i A');
        $attend = new Attendance;
        $attend->user_id = Auth::user()->id;
        $attend->In_Entry = $currenttime;
        $attend->Out_Entry = null;
        $attend->Attendance_Date = Carbon::now()->format('Y-m-d');
        //dd($attend);
        $attend->save();

        return response()->json(['data',$currenttime]);
    }

    public function OutAttendance()
    {
        $strtime = $_GET['stime'];
        $uid =  Auth::user()->id;
        
        $currenttime = Carbon::now('Asia/Kolkata')->format('h:i A');

        //$outentry = DB::table("attendace")->where('user_id',$uid)->where("In_Entry",$strtime)->update(["Out_Entry" => $currenttime]);
        $outentry = Attendance::where("In_Entry","=",$strtime)->get();
        dd($outentry);

        return response()->json(['data'=>$currenttime]);
    }

    public function WorkHours()
    {
        $currentdate = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $duration = Attendance::where('user_id','=',Auth::user()->id)->where('Attendance_Date','=',$currentdate)->get();

        foreach($duration as $row)
        {
            $start = str_replace("AM","",$row['In_Entry']);
            $strconvert = strtotime($start);

            $end = strtotime($row['Out_Entry']);
            
            if($end != null)
            {
                
                $data = $end-$strconvert;
                $hours = gmdate("h:i:s",$data);
                
                return response()->json($hours);
            }
            else
            {
                $currenttime = Carbon::now('Asia/Kolkata')->format('h:i A');
                $str = str_replace("AM","",$currenttime);
                $endtime = strtotime($str);
                
                $data = $endtime-$strconvert;
                $hours = gmdate("h:i:s",$data);
                
                return response()->json($hours);

            }
        }
    
    }
}
