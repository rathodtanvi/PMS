<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Project;
use App\Models\Technology;
use App\Models\DailyWorkEntry;
use Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;

class ReportsController extends Controller
{
    public function report_attendance()
    {
        $employee = User::where('roles_id','!=',1)->get();
        return view('Reports.Attendance.index',compact('employee'));
    }
    
    public function report_attendancelist(Request $request)
    {    
      
      $atten_result=[];
      $daily_work_result=[];
        $Holiday=[];
         $holidays=Holiday::all();
          foreach($holidays as $holiday)
          {
            $period_holiday = CarbonPeriod::create($holiday->start_date, $holiday->end_date);
             $datas_holiday = $period_holiday->toArray();
             foreach($datas_holiday as $data_holiday)
             {
                $Holiday[]=$data_holiday->format('Y-m-d');
             }
           
          } 
        $attendance=[];
        
        //print_r($result);
        $empnm = $_GET['empnm'];
        $fdate = $_GET['fdate'];
        $tdate = $_GET['tdate'];
        $period = CarbonPeriod::create($fdate, $tdate);
        $datas = $period->toArray();
      
        if(Auth::user()->roles_id == 1)
        {
            if($_GET['empnm'] == "all")
            {
                $users_data = User::where('roles_id','!=',1)->get();
            }
                  
            else
            {
                 $users_data = User::where('id',$empnm)->get();  
            }
           $users_attendance=[];
           foreach($users_data as $data)
           {
              $attendance_time=[];
              $daily_data=[];
               $attendance = [];
               $times=[];
               $out_data=[];
               foreach($datas as $date)
               { 
                    
                  $daily_work =DailyWorkEntry::where('user_id',$data->id)->whereDate('entry_date',$date->format('Y-m-d'))->pluck('entry_duration')->toarray();
                
                  if($date->format('l') == 'Saturday' || $date->format('l') == 'Sunday' || in_array($date->format('Y-m-d'),$Holiday))
                 {
                   $attendance[$date->format('Y-m-d')] = 'Holiday';
                 }
                 else{
                   $getAtime = Attendance::where("user_id",$data->id)->whereDate("attendance_date",$date->format('Y-m-d'))->get();
                   $get_time= Attendance::where("user_id",$data->id)->whereDate("attendance_date",$date->format('Y-m-d'))->pluck('out_entry','in_entry')->toarray();
                
                   foreach($getAtime as $Atime)
                   {
                    if($Atime->out_entry != '')
                    {
                     // $out_data[]=$Atime->out_entry;
                     $start = new DateTime(date("H:i:s", strtotime($Atime['in_entry'])));
                     $end =  new DateTime(date("H:i:s", strtotime($Atime['out_entry'])));
                     $interval = $start->diff($end);
                     $times[] = $interval->format('%h').":".   $interval->format('%i').":".$interval->format('%s');
                    }
                    else
                    {
                        $attendance[$date->format('Y-m-d')] = 'no out';
                    }
                   
                        
                   }  
             
                   $seconds  = 0;
                   foreach ($times as $time) 
                   {
                       list($hour, $minute , $second) = explode(':', $time);
                       $seconds  += $hour * 3600;
                       $seconds  += $minute * 60;
                       $seconds  += $second ;
                   }
                   $hours = floor($seconds  / 3600);
                   $seconds -= $hours * 3600;

                   $minutes  = floor($seconds/60);
                   $seconds -= $minutes * 60;
                   $attendanceTotal = sprintf('%02d:%02d', $hours, $minutes); 
                   if($attendanceTotal == "00:00")
                   {
                       $attendance[$date->format('Y-m-d')] ="Absent";
                   }
                   else
                   {
                       $attendance[$date->format('Y-m-d')] =$attendanceTotal;
                   }

                 }
                 
                  //Attendance Duration
                  if($date->format('l') == 'Saturday' || $date->format('l') == 'Sunday' || in_array($date->format('Y-m-d'),$Holiday))
                  {
                     $attendance_time[$date->format('Y-m-d')] = ['Holiday'];
                  }
                  else
                  {
                  if($get_time == [])
                  {
                      $attendance_time[$date->format('Y-m-d')] =["Absent"];
                  }
                  else 
                  {
                   $attendance_time[$date->format('Y-m-d')]= $get_time;
                  }
                  }
                  //work Duration 
                  if($date->format('l') == 'Saturday' || $date->format('l') == 'Sunday' || in_array($date->format('Y-m-d'),$Holiday))
                  {
                    $daily_data[$date->format('Y-m-d')]= ['Holiday'];
                  }
                  else
                  {
                  if($daily_work == [])
                  {
                    $daily_data[$date->format('Y-m-d')] =["Absent"];
                  }
                  else 
                  {
                    $daily_data[$date->format('Y-m-d')]= $daily_work;
                  }
                  }
              
                 

              }
               $users_attendance[$data->id] = $attendance;
                //Attendance Duration
               $atten_result[$data->id]=$attendance_time;
                //dailywork
                $daily_work_result[$data->id]=$daily_data;
           }
            // dd($daily_work_result);
           //dd($atten_result);
          // dd($users_attendance);
       
          $RcountDay = Attendance::where("user_id",$empnm)->whereBetween("attendance_date",[$fdate,$tdate])->distinct()->count('attendance_date');          
          $countday_h = 8*($RcountDay);  // Attendance Hours
          






            return view('Reports.Attendance.tabledata',compact('users_attendance','users_data','getAtime','datas','atten_result','daily_work_result'
                         ,'countday_h')); 
        }
        else
        {
            
            //$data= Attendance::where('user_id',Auth::user()->id)->whereBetween('Attendance_Date',[$data1,Carbon::parse($data2)->endofDay()])->distinct()->get('Attendance_Date');
            $today = Carbon::now()->format('Y-m-d');
            if($tdate < $today)
            {
                $period = CarbonPeriod::create($fdate, $tdate);
            }
            else
            {
                $period = CarbonPeriod::create($fdate, $today);
            }
                            
            $datas = $period->toArray();

            $a="";
                return DataTables::of($datas)
                    ->addIndexColumn()
                    ->addColumn('Attendance_Date', function($row)
                    {
                        return Carbon::parse($row)->format('l, F d,Y');
                    })  
                    ->addColumn('mergeColumn', function($row)use($a)
                    {
                        if($row->format('l') == 'Saturday' || $row->format('l') == 'Sunday')
                        {
                            return "<div style='color:orange'> Holiday </div>";
                        }
                        else
                        {
                            $stime= Attendance::where('user_id',Auth::user()->id)->whereDate('attendance_date',$row->format('Y-m-d'))->pluck('out_entry','in_entry')->toarray();
                            if(sizeof($stime) == '0')
                            {
                                return "<div style='color:red'> Absent </div>";
                            }
                            else
                            {
                                foreach($stime as $x=> $value)
                                {
                                    $a .= "$x - $value<br>";
                                }
                                return  $a;
                            }
                        }
                    })
                    ->addColumn('attendance_duration', function($row)
                    {
                        if($row->format('l') == 'Saturday' || $row->format('l') == 'Sunday')
                        {
                            return "<div style='color:orange'> Holiday </div>";
                        }
                        else
                        {
                            $stime= Attendance::where('user_id',Auth::user()->id)->whereDate('attendance_date',$row->format('Y-m-d'))->get();
                            if(sizeof($stime) == '0')
                            {
                                return "<div style='color:red'> Absent </div>";
                            }
                            else
                            {
                                $attendance = [];
                                foreach($stime as $value)
                                {
                                    if($value->out_entry != Null)
                                    {
                                        $start = new DateTime(date("H:i:s", strtotime($value['in_entry'])));
                                        $end =  new DateTime(date("H:i:s", strtotime($value['out_entry'])));
                                        $interval = $start->diff($end);
                                        $times[] = $interval->format('%h').":".$interval->format('%i').":".$interval->format('%s');
                                        
                                    }
                                    else
                                    {
                                        return '<div class="badge bg-danger" style="font-size:15px;padding:7px;">No OUT</div>';
                                    }
                                    
                                }
                                $seconds  = 0;
                                foreach ($times as $time) 
                                {
                                    list($hour, $minute , $second) = explode(':', $time);
                                    $seconds  += $hour * 3600;
                                    $seconds  += $minute * 60;
                                    $seconds  += $second ;
                                }
                                $hours = floor($seconds  / 3600);
                                $seconds  -= $hours * 3600;

                                $minutes  = floor($seconds/60);
                                $seconds -= $minutes * 60;
                                $attendance = sprintf('%02d:%02d', $hours, $minutes);

                                return $attendance;
                            }
                        }
                    })
                    ->escapeColumns([])
                    ->rawColumns(['mergeColumn'])
                    ->make(true);
        }
        
        //return view('Reports.Attendance.tabledata',compact('users','dates','entrytime','workduration'));
    }
	
    
    
    public function report_attendancetotal()
    {
        if(Auth::user()->roles_id == 1)
        {
            
            //Required Attendance Hours & Days
            $empnm = $_GET['empnm'];
            $fdate = date_create($_GET['fdate']);
            $tdate = date_create($_GET['tdate']);
            
            // Attendance Day
            $RcountDay = Attendance::where("user_id",$empnm)->whereBetween("attendance_date",[$fdate,$tdate])->distinct()->count('attendance_date');
                        
            $countday_h = 8*($RcountDay);  // Attendance Hours
            //Actual Attendance Hours & Days
            $getAttendance= Attendance::where('user_id','=',$empnm)->whereBetween('attendance_date',[$fdate , $tdate])->get();
            
            $times = [];
            foreach($getAttendance as $row)
            {
                if($row['out_entry'] != Null)
                {
                    $start = new DateTime(date("H:i:s", strtotime($row['in_entry'])));
                    $end =  new DateTime(date("H:i:s", strtotime($row['out_entry'])));
                    $interval = $start->diff($end);
                    $times[] = $interval->format('%h').":".$interval->format('%i').":".$interval->format('%s');
                    
                    $ActualDay = $RcountDay;
                }
                else
                {
                    $ActualDay = $RcountDay-1;
                }
            }
            $seconds  = 0;
            foreach ($times as $time) 
            {
                list($hour, $minute , $second) = explode(':', $time);
                $seconds  += $hour * 3600;
                $seconds  += $minute * 60;
                $seconds  += $second ;
            }
            $hours = floor($seconds  / 3600);
            $seconds -= $hours * 3600;

            $minutes  = floor($seconds/60);
            $seconds -= $minutes * 60;
            $attendance = sprintf('%02d:%02d', $hours, $minutes); //Attendance Hours

            if($RcountDay == '0')
            {
                $ActualDay = $RcountDay;   //Attendance Days
            }
            else
            {
                $ActualDay = $RcountDay-1;   //Attendance Days
            }
            
            //work Duration Hours & Days
            $WorkHours = DailyWorkEntry::where("user_id",'=',$empnm)->whereBetween("entry_date",[$fdate,$tdate])->get();
            
            $entryduration = [];
            foreach($WorkHours as $row)
            {
                $entryduration[] = $row['entry_duration'].":00";
                
            }
            
            $seconds  = 0;
            foreach ($entryduration as $time) 
            {
                
                list($hour, $minute , $second) = explode(':', $time);
                $seconds  += $hour * 3600;
                $seconds  += $minute * 60;
                $seconds  += $second ;
            }
            $hours = floor($seconds  / 3600);
            $seconds -= $hours * 3600;

            $minutes  = floor($seconds/60);
            $seconds -= $minutes * 60;
            $workduration = sprintf('%02d:%02d', $hours, $minutes);

            $data = array("countday_h" => $countday_h , "countday" => $RcountDay , "attendance" => $attendance , 'ActualDay' => $ActualDay , 'workduration' => $workduration);
          //  return json_encode($data);
            // return view('Reports.Attendance.tabledata',compact('countday_h'));
        }
        else
        {
            //Required Attendance Hours & Days
            $fdate = date_create($_GET['fdate']);
            $tdate = date_create($_GET['tdate']);
            
            // Attendance Day
            $RcountDay = Attendance::where("user_id",'=',Auth::user()->id)->whereBetween("attendance_date",[$fdate,$tdate])->distinct()->count('attendance_date');
            
            $countday_h = 8*($RcountDay);  // Attendance Hours

            //Actual Attendance Hours & Days
            $getAttendance= Attendance::where('user_id','=',Auth::user()->id)->whereBetween('attendance_date',[$fdate , $tdate])->get();
            
            $times = [];
            foreach($getAttendance as $row)
            {
                if($row['out_entry'] != Null)
                {
                    $start = new DateTime(date("H:i:s", strtotime($row['in_entry'])));
                    $end =  new DateTime(date("H:i:s", strtotime($row['out_entry'])));
                    $interval = $start->diff($end);
                    $times[] = $interval->format('%h').":".$interval->format('%i').":".$interval->format('%s');
                }
            }
            $seconds  = 0;
            foreach ($times as $time) 
            {
                list($hour, $minute , $second) = explode(':', $time);
                $seconds  += $hour * 3600;
                $seconds  += $minute * 60;
                $seconds  += $second ;
            }
            $hours = floor($seconds  / 3600);
            $seconds -= $hours * 3600;

            $minutes  = floor($seconds/60);
            $seconds -= $minutes * 60;
            $attendance = sprintf('%02d:%02d', $hours, $minutes); //Attendance Hours

            if($RcountDay == '0')
            {
                $ActualDay = $RcountDay;   //Attendance Days
            }
            else
            {
                $ActualDay = $RcountDay-1;   //Attendance Days
            }
            
            //work Duration Hours & Days
            $WorkHours = DailyWorkEntry::where("user_id",'=',Auth::user()->id)->whereBetween("entry_date",[$fdate,$tdate])->get();
            
            $entryduration = [];
            foreach($WorkHours as $row)
            {
                $entryduration[] = $row['entry_duration'].":00";
                
            }
            
            $seconds  = 0;
            foreach ($entryduration as $time) 
            {
                
                list($hour, $minute , $second) = explode(':', $time);
                $seconds  += $hour * 3600;
                $seconds  += $minute * 60;
                $seconds  += $second ;
            }
            $hours = floor($seconds  / 3600);
            $seconds -= $hours * 3600;

            $minutes  = floor($seconds/60);
            $seconds -= $minutes * 60;
            $workduration = sprintf('%02d:%02d', $hours, $minutes);
            
            $data = array("countday_h" => $countday_h , "countday" => $RcountDay , "attendance" => $attendance , 'ActualDay' => $ActualDay , 'workduration' => $workduration);
            return json_encode($data);
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
