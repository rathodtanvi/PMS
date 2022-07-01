<?php

namespace App\Http\Controllers;

use App\DataTables\DailyworkentryDataTable;
use App\Models\ProjectAllotment;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\Technology;
use App\Models\DailyWorkEntry;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;
use Carbon\Carbon;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon as SupportCarbon;



class ReportsController extends Controller
{
    public function report_attendance()
    {
        $employee = User::where('roles_id','!=',1)->get();
        return view('Reports.Attendance.index',compact('employee'));
    }
    
    public function report_attendancelist(Request $request)
    {    
        //$empnm = $_GET['empnm'];
        $fdate = $_GET['fdate'];
        $tdate = $_GET['tdate'];

        $times = [];
        $work = [];
        $getdate = [];

        if(Auth::user()->roles_id == 1)
        {
            if($_GET['empnm'] == "all")
            {
                $users = User::where('roles_id','!=',1)->get();
                
                $dates = CarbonPeriod::create($fdate, $tdate);
                foreach($users as $user)
                {
                    foreach ($dates as $date)
                    {
                        //work Duration
                        $getwork = DailyWorkEntry::where("user_id",$user->id)->whereDate("entry_date",$date->format('Y-m-d'))->get();
                        
                        foreach($getwork as $works)
                        {
                            $work[][$user->id] = [$date->format('Y-m-d')=>["work"=>$works->entry_duration]]; 
                        }

                        //Attendance Duration
                        $getAtime = Attendance::where("user_id",$user->id)->whereDate("attendance_date",$date->format('Y-m-d'))->get();
                        if(sizeof($getAtime) != 0)
                        {
                            foreach($getAtime as $Atime)
                            {
                                if($Atime->out_entry!= Null)
                                {
                                    $start = new DateTime(date("H:i:s", strtotime($Atime['in_entry'])));
                                    $end =  new DateTime(date("H:i:s", strtotime($Atime['out_entry'])));
                                    $interval = $start->diff($end);
                                    $times[][$Atime->user_id] = [$Atime->attendance_date=>$interval->format('%h').":".$interval->format('%i').":".$interval->format('%s')];
                                } 
                                
                            }
                            
                        }
                        
                    }
                    
                }
                print_r($times);
                dd($work);
                
            }
            
            else
            {
                $users = User::where("id",$_GET['empnm'])->get();
            }
            
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
                    
                    $ActualDay = $RcountDay;    //Actual Day & Working Day
                    
                }
                else
                {
                    $ActualDay = $RcountDay-1;  //Actual Day & Working Day
                    
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
            return json_encode($data);
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
                    
                    $ActualDay = $RcountDay;       //Actual Day & Working Day
                }
                else
                {
                    $ActualDay = $RcountDay-1;     //Actual Day & Working Day
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
            $attendance = sprintf('%02d:%02d', $hours, $minutes); // Actual Attendance Hours
            
        
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
    
    public function report_daily_work_entry()
    {
        $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        $users = User::where('roles_id',"!=",'1')->get();
        return view('Reports.DailyWorkEntry.index',compact('projects','users'));
    }

    public function getproject()
    {
        $pnm = $_GET['pname'];
        $projects = [];
        $cmplt_projectnm = [];
        $incmplt_projectnm = [];

        if($pnm == '1')
        {
            if(Auth::user()->roles_id != 1)
            {
                $getproject = ProjectAllotment::where('user_id',Auth::user()->id)->get();
            }
            else
            {
                $getproject = ProjectAllotment::get();
            }
            foreach($getproject as $project)
            {
                $projects[] = Project::find($project->project_id);
                
            }
            $projectnm = array_unique($projects);

        }
        elseif ($pnm == '2') 
        {
            if(Auth::user()->roles_id != 1)
            {
                $getproject = ProjectAllotment::where('user_id',Auth::user()->id)->get();
            }
            else
            {
                $getproject = ProjectAllotment::get();
            }
            foreach($getproject as $project)
            {
                $projects = Project::find($project->project_id);
                if($projects->status == '1')
                {
                    $projectid = $projects->id;
                    $cmplt_projectnm[] = Project::find($projectid);
                }
            }
            $projectnm = array_unique($cmplt_projectnm);
            
        }
        else
        {
            if(Auth::user()->roles_id != 1)
            {
                $getproject = ProjectAllotment::where('user_id',Auth::user()->id)->get();
            }
            else
            {
                $getproject = ProjectAllotment::get();
            }
            foreach($getproject as $project)
            {
                $projects = Project::find($project->project_id);
                if($projects->status == '0')
                {
                    $projectid = $projects->id;
                    $incmplt_projectnm[] = Project::find($projectid);
                }
            }
            $projectnm = array_unique($incmplt_projectnm);
            
        }
        return json_encode($projectnm);
    }
    public function get_technology()
    {
        $pnm = $_GET['pname'];
        $emp = [];
        $tech_nm = [];
        $empnm = [] ;

        if(Auth::user()->roles_id != 1)
        {
            $technology = Project::find($pnm);
            $tech = explode(',',$technology->technology_id);
            $technm = Technology::whereIn('id',$tech)->get();

            foreach($technm as $row)
            {
                $tech_nm[] = "<option value='".$row->id."'>".$row->technology_name."</option>";

                
            }
            $data = array('currentuser' => 'Admin' , 'tech_nm' => $tech_nm);
        }
        else
        {
            $getuser = ProjectAllotment::where('project_id',$pnm)->get();
            //dd($getuser);
            foreach($getuser as $user)
            {
                $emp[] = explode(',',$user->user_id);
            }
            $users = User::whereIn('id',$emp)->get();
            foreach($users as $usernm)
            {
                $empnm[] =  "<option value='".$usernm->id."'>".$usernm->name."</option>";
            }
            $data = array('empnm' => $empnm);
        }
        
        
        return json_encode($data);
    }

    public function report_dailyworklist()
    {
        /*$pnm = $_GET['pnm'];
        $tnm = $_GET['tnm'];*/
        
        $fdate = $_GET['fdate'];
        $tdate = $_GET['tdate'];
        
        if(Auth::user()->roles_id != 1)
        {
            
            $work_info = DailyWorkEntry::where('user_id',Auth::user()->id)->where('project_id',$_GET['pnm'])->whereBetween('entry_date',[$fdate,$tdate])->get();
            
            return DataTables::of($work_info)
                ->addIndexColumn()
                ->addColumn('technology', function($row)
                {
                    
                    $data = Technology::whereIn('id',$_GET['tnm'])->pluck('technology_name')->toArray();
                    
                    return $data;
                }) 
                ->addColumn('project', function($row)
                {
                    $project = Project::find($_GET['pnm']);
                    return $project->project_name;
                })
                ->addColumn('employee', function($row)
                {
                    return Auth::user()->name;
                })  
                ->addColumn('date', function($row)
                {
                    return $row->entry_date;
                })
                ->addColumn('work_information', function($row)
                {
                    
                    return "<b> Duration : </b>".$row->entry_duration."<br/><b> Type : </b>".$row->work_type."<br/> <b> Productive : </b>".$row->productive;
                    
                })
                ->addColumn('work_detail', function($row)
                {
                    
                    return "<b> Work Entry : </b>".$row->description;
                    
                })
                ->escapeColumns([])
                ->rawColumns(['technology'])
                ->make(true);
        }
        else
        {
            $unm = $_GET['unm'];
            //dd($unm);
            if($unm = "all")
            {
                
                $users = User::where('roles_id','!=','1')->get();
                $period = CarbonPeriod::create($_GET['fdate'], $tdate);
                $datas = $period->toArray();

                //$work_info = DailyWorkEntry::with('user')->with('project')->whereBetween('entry_date',[$_GET['fdate'],$_GET['tdate']])->get();
            
                $getalldata = ProjectAllotment::with('user')->with('project')->select('project_allotment.*','daily_work_entries.*')->join('daily_work_entries', 'daily_work_entries.project_id', '=', 'project_allotment.project_id')
                ->whereColumn('daily_work_entries.user_id', '=', 'project_allotment.user_id')
                ->whereBetween('entry_date',[$_GET['fdate'],$_GET['tdate']])
                ->get();
                
                
                $gettech = Technology::get();

                return view('Reports.DailyWorkEntry.GetAllUserData',compact('users','getalldata','gettech'));
            }
            else
            {
                
                $work_info = DailyWorkEntry::with('user')->with('project')->whereIn('user_id',$_GET['unm'])->where('project_id',$_GET['pnm'])->whereBetween('entry_date',[$fdate,$tdate])->get();
                $uname = [];

                return DataTables::of($work_info)
                    ->addIndexColumn()
                    ->addColumn('technology', function($row)
                    {
                        $project = Project::find($_GET['pnm']);
                        $tech = explode(',',$project->technology_id);
                        $data = Technology::whereIn('id',$tech)->pluck('technology_name')->toArray();
                        
                        return $data;
                    }) 
                    ->addColumn('project', function($row)
                    {
                        //$project = Project::find($_GET['pnm']);
                        return $row->project->project_name;
                    })
                    ->addColumn('employee', function($row)
                    {
                        return $row->user->name;
                    })  
                    ->addColumn('date', function($row)
                    {
                        return $row->entry_date;
                    })
                    ->addColumn('work_information', function($row)
                    {
                        //$pnm = $_GET['pnm'];

                        return "<b> Duration : </b>".$row->entry_duration."<br/><b> Type : </b>".$row->work_type."<br/> <b> Productive : </b>".$row->productive;
                        
                    })
                    ->addColumn('work_detail', function($row)
                    {
                        //$pnm = $_GET['pnm'];

                        return "<b> Work Entry : </b>".$row->description;
                        
                    })
                    ->escapeColumns([])
                    ->rawColumns(['technology'])
                    ->make(true);
                }
        }
    }
    public function report_dailyworktotal()
    {
        $pnm = $_GET['pname'];
        
        $fdate = $_GET['fdate'];
        $tdate = $_GET['tdate'];

        $duration = [];
        if(Auth::user()->roles_id != 1)
        {
            
            $work_info = DailyWorkEntry::where('user_id',Auth::user()->id)->where('project_id',$pnm)->whereBetween('entry_date',[$fdate,$tdate])->get();
        }
        else
        {
            /*if($unm = 'all')
            {
                $getallworks = DailyWorkEntry::whereBetween('entry_date',[$fdate,$tdate])->get();
                //dd($getallworks);
                return view('Reports.DailyWorkEntry.GetAllUserData',compact('getallworks'));
            }
            else
            {*/
                $work_info = DailyWorkEntry::whereIn('user_id',$_GET['unm'])->where('project_id',$pnm)->whereBetween('entry_date',[$fdate,$tdate])->get();
            //}
        }
        
        $totDays = sizeof($work_info);
        
        foreach($work_info as $winfo)
        {
            $duration[] = $winfo->entry_duration.":0";
        }
        $seconds  = 0;
        foreach ($duration as $time) 
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
        $entry_duration = sprintf('%02d Hours %02d Minutes', $hours, $minutes);
        
        $data = array("totDays" => $totDays , "entry_duration" => $entry_duration);
        return json_encode($data);
    }

    public function pdf_file()
    {
        /*$employees = User::all();
        $pdf = PDF::loadView('Reports.DailyWorkEntry.GetAllUserData',compact("employees"));

        return $pdf->download('userdata.pdf'); */
        
        $users = User::where('roles_id','!=','1')->get();
                
        $getalldata = ProjectAllotment::with('user')->with('project')->select('project_allotment.*','daily_work_entries.*')->join('daily_work_entries', 'daily_work_entries.project_id', '=', 'project_allotment.project_id')
        ->whereColumn('daily_work_entries.user_id', '=', 'project_allotment.user_id')
        ->whereBetween('entry_date',[$_GET['fdate'],$_GET['tdate']])
        ->get();
                
        $gettech = Technology::get();

        $pdf = PDF::loadView('Reports.DailyWorkEntry.GetAllUserData',compact('users','getalldata','gettech'));
        
        return $pdf->download('userdata.pdf');
    }
}
