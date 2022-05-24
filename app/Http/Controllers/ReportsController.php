<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\Attendance;
use Hash;
use DataTables;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function report_attendance()
    {
        return view('User.Reports.Attendance.index');
    }
   
    public function report_attendancelist(Request $request)
    {
        if ($request->ajax()) {
            $data=Attendance::where('user_id',Auth::id())->whereDate('created_at',  Carbon::today())->get();
            //dd($data);
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Attendance_Date', function($row){
                        return Carbon::parse($row->Attendance_Date)->format('l, F d,Y');
                    })  
                    ->addColumn('mergeColumn', function($row){
                      
                                return $row->In_Entry.'AM - '.$row->Out_Entry.'PM<br>';
                    })
                    ->addColumn('attendance_duration', function($row){
                         
                    })
                    ->escapeColumns([])
                    ->rawColumns(['picture', 'confirmed'])
                    ->make(true);
           }
    }

    public function report_daily_work_entry()
    {
        $projects=ProjectAllotment::where('user_nm',Auth::user()->name)->get();
        return view('User.Reports.DailyWorkEntry.index',compact('projects'));
    }
    public function report_project_total_hour()
    {
        $projects=ProjectAllotment::where('user_nm',Auth::user()->name)->get();
        return view('User.Reports.ProjectHour.index',compact('projects'));
    }

}
