<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use Illuminate\Http\Request;
use Auth;

class ReportsController extends Controller
{
    public function report_attendance()
    {
        return view('User.Reports.Attendance.index');
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
