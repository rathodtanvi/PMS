<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function report_attendance()
    {
        return view('User.Reports.Attendance.index');
    }

    public function report_daily_work_entry()
    {
        return view('User.Reports.DailyWorkEntry.index');
    }
    public function report_project_total_hour()
    {
        return view('User.Reports.ProjectHour.index');
    }
}
