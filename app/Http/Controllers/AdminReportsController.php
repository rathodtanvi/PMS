<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function admin_report_attendance()
    {
        $employee=User::all();
        return view('Admin.Reports.Attendance.index',compact('employee'));
    }
}
