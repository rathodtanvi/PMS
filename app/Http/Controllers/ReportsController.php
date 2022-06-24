<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\Technology;
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
            $projects=Project::all();
        }
        else
        {
            $projects=ProjectAllotment::with('technology')->where('user_id',Auth::id())->get();
        }
        return view('Reports.ProjectHour.index',compact('projects'));
    }
    public function total_hour(Request $request)
    {
        $date=$request->input('date');
        $date_end=$request->input('date_end');
        $project_id=$request->input('project');
        $technology = Technology::get(); 
        if(Auth::user()->roles_id == 1)
        {
            $projectname=ProjectAllotment::with('project')->with('user')->with('technology')
            ->whereIn('project_allotment.project_id',$project_id)
            ->join('daily_work_entries','daily_work_entries.project_id', '=', 'project_allotment.project_id')
            ->whereBetween('entry_date',[$date,$date_end])
            ->get();

            $info_data = [];
            for($i=0; $i < sizeof($project_id); $i++)
            {
              $daily = DailyWorkEntry::with('user')->get()->where('project_id',$project_id[$i])->whereBetween('entry_date',[$date,$date_end])
              ->pluck('user.name')->toarray();
              $info_data +=(array($project_id[$i]=>$daily));
            }

            for($i=0; $i < sizeof($project_id); $i++)
            {
                $tech = ProjectAllotment::where('project_id',$project_id[$i])->get();
                  foreach($tech->unique('project_id') as $take)
                  {
                            $arr = explode(",",$take->technology_id);
                            $data = Technology::whereIn('id',$arr)->get();
                            foreach($data as $row)
                            {
                                $tdata[] = $row->technology_name; 
                            } 
                  }
                  $tech_data [] =(array((array($project_id[$i])[0])=>$tdata));
            }
          
        }
        else
        {
           
            $projectname=ProjectAllotment::with('project')->with('user')->with('technology')
            ->where('project_allotment.user_id',Auth::id())
            ->where('daily_work_entries.user_id',Auth::id())
            ->whereIn('project_allotment.project_id',$project_id)
            ->join('daily_work_entries','daily_work_entries.project_id', '=', 'project_allotment.project_id')
            ->whereBetween('entry_date',[$date,$date_end])
            ->get();
            $info_data = [];
            $tech_data= [];
        }
            $a = [];
            $a_data = [];
            $b_data = [];
            $b = [];
            for($i=0; $i<sizeof($project_id); $i++)
             {
                if(Auth::user()->roles_id == 1)
                {
                    $dailyworks=DailyWorkEntry::where('project_id',$project_id[$i])
                    ->whereBetween('entry_date',[$date,$date_end])->pluck('entry_duration')->toarray();  

                    $daily_works=DailyWorkEntry::where('project_id',$project_id[$i])
                     ->whereBetween('entry_date',[$date,$date_end])->where('productive','2')->pluck('entry_duration')->toarray(); 

                }
                else
                {
                    $dailyworks=DailyWorkEntry::where('user_id',Auth::id())->where('project_id',$project_id[$i])
                    ->whereBetween('entry_date',[$date,$date_end])->where('productive','1')->pluck('entry_duration')->toarray(); 

                     $daily_works=DailyWorkEntry::where('user_id',Auth::id())->where('project_id',$project_id[$i])
                     ->whereBetween('entry_date',[$date,$date_end])->where('productive','2')->pluck('entry_duration')->toarray();  
                }
                    $sum_minutes = 0;
                    foreach($dailyworks as $time) {
                    $explodedTime = array_map('intval', explode(':', $time ));
                    $sum_minutes += $explodedTime[0]*60+$explodedTime[1];
                    }
                    $sumTime = floor($sum_minutes/60).' Hours : '.floor($sum_minutes % 60).' Minutes';
                    $hr =round(($sum_minutes/60)/8,8);
                    $a  += array(array($project_id[$i])[0] => array($sumTime)[0]); 
                    $b  += array(array($project_id[$i])[0] => $hr);
                   

                    $sum_minutes_data = 0;
                    foreach($daily_works as $time) {
                    $explodedTime_data = array_map('intval', explode(':', $time ));
                    $sum_minutes_data += $explodedTime_data[0]*60+$explodedTime_data[1];
                    }
                    $sumTime_data = floor($sum_minutes_data/60).' Hours : '.floor($sum_minutes_data % 60).' Minutes';
                    $hr_data =round(($sum_minutes_data/60)/8,8);
                    $a_data  += array(array($project_id[$i])[0] => array($sumTime_data)[0]); 
                    $b_data  += array(array($project_id[$i])[0] => $hr_data);
                      


                    $sum_minutes_arr = 0;
                    $p_total=floor($sum_minutes/60).':'.floor($sum_minutes % 60);
                    $u_total=floor($sum_minutes_data/60).':'.floor($sum_minutes_data % 60);
                     $arr=array($p_total,$u_total);
                     foreach($arr as $arr_time) {
                        $explodedTime_arr = array_map('intval', explode(':', $arr_time ));
                        $sum_minutes_arr += $explodedTime_arr[0]*60+$explodedTime_arr[1];
                        }
                    $sumTime_arr = floor($sum_minutes_arr/60).' Hours : '.floor($sum_minutes_arr % 60).' Minutes';
                    $hr_arr =round(($sum_minutes_arr/60)/8,8);
             }
                
             ['pms'=>'16 Hours : 16 Minutes' ,'API'=>'7 Hours : 23 Minutes'];
            return view('Reports.ProjectHour.addtable',compact('projectname','date','date_end','a','b','dailyworks',
            'info_data','tech_data','a_data','b_data','technology','sumTime_arr','hr_arr'));
    }     
}
