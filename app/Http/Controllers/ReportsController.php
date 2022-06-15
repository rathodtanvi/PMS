<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\DailyWorkEntry;
use App\Models\User;
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
       return view('User.Reports.Attendance.index');
    }
   
    public function report_attendancelist(Request $request)
    {
        if ($request->ajax())
         {
            $data1= $request->input('date1');
            $data2= $request->input('date2');  
            $data= Attendance::where('user_id',Auth::id())->whereBetween('Attendance_Date',[$data1,Carbon::parse($data2)->endofDay()])->distinct()->get('Attendance_Date');
            $a="";
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Attendance_Date', function($row){
                        return Carbon::parse($row->Attendance_Date)->format('l, F d,Y');
                    })  
                    ->addColumn('mergeColumn', function($row)use($a){
                      $stime= Attendance::where('user_id',Auth::id())->whereDate('Attendance_Date',$row->Attendance_Date)->pluck('Out_Entry','In_Entry')->toarray();
                      // dd($stime);   
                      foreach($stime as $x=> $value)
                      {
                            $a .= "$x-$value<br>";
                      }
                      return  $a;
                    })
                    ->addColumn('attendance_duration', function($row){
                       $start= str_replace("AM"," ",$row->In_Entry);
                       $strconv = new DateTime($start);

                       $end=str_replace("AM"," ",$row->Out_Entry);
                       $endconv = new DateTime($end);
                       $time_diff=$endconv->diff($strconv);
                       $htime[] = $time_diff->format('%H');
                       $mtime[] = $time_diff->format('%I');
                       $h_sum = array_sum($htime);
                       $m_sum = array_sum($mtime);
                          return  $h_sum.':'.$m_sum;
                    })
                    ->escapeColumns([])
                    ->rawColumns(['mergeColumn'])
                    ->make(true);
           }
    }
     
    public function report_daily_work_entry()
    {

        $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        return view('User.Reports.DailyWorkEntry.index',compact('projects'));
    }
    public function report_project_total_hour()
    {
        if(Auth::user()->roles_id == 1)
        {
            $employee=User::all();
            $projects=Project::all();
        }
        else
        {
            $employee=User::where('roles_id',Auth::id())->get();
            $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        }
       
        return view('Reports.ProjectHour.index',compact('projects','employee'));
    }
    public function total_hour(Request $request)
    {
        
        $date=$request->input('date');
        $date_end=$request->input('date_end');
        $project_id=$request->input('project');
        $tech=ProjectAllotment::where('user_id',Auth::id())->where('project_id',$project_id)->pluck('technology');
        $dailyworks=DailyWorkEntry::where('user_id',Auth::id())->where('project_id',$project_id)->whereBetween('entry_date',[$date,$date_end])->pluck('entry_duration')->toarray();
        $sum_minutes = 0;
        foreach($dailyworks as $time) {
            $explodedTime = array_map('intval', explode(':', $time ));
            $sum_minutes += $explodedTime[0]*60+$explodedTime[1];
        }
        $sumTime = floor($sum_minutes/60).' Hours : '.floor($sum_minutes % 60).' Minutes';
        return response()->json(['success'=>true, 'dailyworks'=>$sumTime,'project_id'=>$project_id,'tech'=>$tech]);
    }     
}
