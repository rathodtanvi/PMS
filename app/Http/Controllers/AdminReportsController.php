<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Attendance;
use Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function admin_report_attendance()
    {
        $employee = User::all();
        return view('Admin.Reports.Attendance.index',compact('employee'));
    }
    public function admin_report_attendancelist(Request $request)
    {      
        $empnm = $request['empnm'];
        $fdate = $request['fdate'];
        $tdate = $request['tdate'];

        
        $data = Attendance::where('user_id','=',$empnm)->whereBetween('Attendance_Date',[$fdate,$tdate])->get();
        $uniquedata = array_unique($data);
        
        //return response()->json($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('mergeColumn', function($row){
                    if($row->Out_Entry != Null)
                    {
                        return $row->In_Entry.' - '.$row->Out_Entry;
                    }
                    else
                    {
                        return $row->In_Entry;
                    }
                })
                //->rawColumns(['action'])
                ->make(true);
        
    }

        public function admin_report_daily_work_entry()
        {
            return view('Admin.Reports.DailyWorkEntry.index');
        }

        public function admin_report_project_total_hour()
        {
            $projects=Project::all();
            $employee=User::all();
            return view('Reports.ProjectHour.index',compact('projects','employee'));
        }
        public function employee_summary()
        {
            $employee=User::all();
            return view('Admin.Reports.EmployeeSummary.index',compact('employee'));
        }
        public function project_summary()
        {
            $projects=Project::all();
            return view('Admin.Reports.ProjectSummary.index',compact('projects'));
        }
        public function project_history()
        {
            $projects=Project::all();
            return view('Admin.Reports.ProjectHistory.index',compact('projects'));
        }
}
