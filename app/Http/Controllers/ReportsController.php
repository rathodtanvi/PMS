<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use App\Models\DailyWorkEntry;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
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
                $period = CarbonPeriod::create($fdate, '2022-06-24');
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

            /*if($RcountDay == '0')
            {
                $ActualDay = $RcountDay;   //Attendance Days
            }
            else
            {
                $ActualDay = $RcountDay-1;   //Attendance Days
            }*/
            
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
        $projects=ProjectAllotment::where('user_id',Auth::id())->get();
        return view('User.Reports.ProjectHour.index',compact('projects'));
    }

}
