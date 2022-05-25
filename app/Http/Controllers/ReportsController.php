<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use Hash;
use DataTables;
use Illuminate\Http\Request;
use Auth;
use Nette\Utils\DateTime;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function report_attendance()
    {
       
      $datas=Attendance::where('user_id',Auth::id())->whereDate('created_at',Carbon::today())->get();
     //  $datas = Attendance::where('user_id',Auth::id())->distinct()->get('user_id');
       $entry= Attendance::where('user_id',Auth::id())->whereDate('created_at',  Carbon::today())->pluck('In_Entry','Out_Entry')->toarray();
        $time=Attendance::where('user_id',Auth::id())->whereDate('created_at',  Carbon::today())->get();
       return view('User.Reports.Attendance.index',compact('datas','entry'));
    }
   
    public function report_attendancelist(Request $request)
    {
       
  
        // if ($request->ajax())
        //  {

        //     $data=Attendance::where('user_id',Auth::id())->whereDate('created_at',  Carbon::today())->get();
        //     return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('Attendance_Date', function($row){
        //                 return Carbon::parse($row->Attendance_Date)->format('l, F d,Y');
        //             })  
        //             ->addColumn('mergeColumn', function($row){
        //               // return $row->In_Entry.'- '.$row->Out_Entry.'<br>';
        //               $stime= Attendance::where('user_id',Auth::id())->whereDate('created_at',  Carbon::today())->pluck('In_Entry','Out_Entry')->toarray();
        //               return   $jdata=  json_encode($stime);
                      
                       
                   
        //             })
        //             ->addColumn('attendance_duration', function($row){
        //                $start= str_replace("AM"," ",$row->In_Entry);
        //                $strconv = new DateTime($start);

        //                $end=str_replace("AM"," ",$row->Out_Entry);
        //                $endconv = new DateTime($end);
        //                $time_diff=$endconv->diff($strconv);
        //                $htime[] = $time_diff->format('%H');
        //                $mtime[] = $time_diff->format('%I');
        //                $h_sum = array_sum($htime);
        //                $m_sum = array_sum($mtime);
        //                   return  $h_sum.':'.$m_sum;
        //             })
        //             ->escapeColumns([])
        //             ->rawColumns(['mergeColumn'])
        //             ->make(true);
        //    }
    }
     
    public function report_daily_work_entry()
    {
        $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        return view('User.Reports.DailyWorkEntry.index',compact('projects'));
    }
    public function report_project_total_hour()
    {
        $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        return view('User.Reports.ProjectHour.index',compact('projects'));
    }

}
