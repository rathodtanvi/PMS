<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\DailyWorkEntryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectAllotmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\ReportsController;
use Illuminate\support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () { 

//Admin
Route::get('/home', [AdminController::class, 'home'])->name('home');
Route::get('/myprofile', [AdminController::class, 'myprofile'])->name('myprofile');
Route::post('/changepassword', [AdminController::class, 'changepassword'])->name('changepassword');
Route::get('/employee_list', [AdminController::class, 'employee_list'])->name('employee_list');

//EmployeeController
Route::get('/employee', [EmployeeController::class, 'employee'])->name('employee');
Route::get('/employeelist', [EmployeeController::class, 'employeelist'])->name('employeelist');
Route::get('/addemployee', [EmployeeController::class, 'addemployee'])->name('addemployee');
Route::post('/add', [EmployeeController::class, 'add'])->name('add');
Route::get('/status/{id}', [EmployeeController::class, 'status'])->name('status');
Route::get('/viewdata/{id}', [EmployeeController::class, 'viewdata'])->name('viewdata');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');


//User
Route::get('/userhome', [UserController::class, 'userhome'])->name('userhome');
Route::get('/userprofile', [UserController::class, 'userprofile'])->name('userprofile');
Route::post('/userchangepassword', [UserController::class, 'userchangepassword'])->name('userchangepassword');

//DailyWorkEntry
Route::get('/daily_work_entry', [DailyWorkEntryController::class, 'daily_work_entry'])->name('daily_work_entry');
Route::get('/daily_work_entrylist', [DailyWorkEntryController::class, 'daily_work_entrylist'])->name('daily_work_entrylist');
Route::post('/enter_daily_work_entry', [DailyWorkEntryController::class, 'enter_daily_work_entry'])->name('enter_daily_work_entry');
Route::get('/addwork', [DailyWorkEntryController::class, 'addwork'])->name('addwork');
Route::get('/workedit/{id}', [DailyWorkEntryController::class, 'workedit'])->name('workedit');
Route::put('/workupdate/{id}', [DailyWorkEntryController::class, 'workupdate'])->name('workupdate');
Route::get('/workdelete/{id}', [DailyWorkEntryController::class, 'workdelete'])->name('workdelete');

//Leave Controller
Route::get('/leave', [LeaveController::class, 'leave'])->name('leave');
Route::get('/leavelist', [LeaveController::class, 'leavelist'])->name('leavelist');
Route::get('/addleave', [LeaveController::class, 'addleave'])->name('addleave');
Route::post('/inleave', [LeaveController::class, 'inleave'])->name('inleave');
Route::get('/leavestatus/{id}', [LeaveController::class, 'leavestatus'])->name('leavestatus');
Route::get('/leaveview/{id}', [LeaveController::class, 'leaveview'])->name('leaveview');

//Reports Controller
Route::get('/report_attendance', [ReportsController::class, 'report_attendance'])->name('report_attendance');
Route::get('/report_attendancelist', [ReportsController::class, 'report_attendancelist'])->name('report_attendancelist');
Route::get('/report_daily_work_entry', [ReportsController::class, 'report_daily_work_entry'])->name('report_daily_work_entry');
Route::get('/report_project_total_hour', [ReportsController::class, 'report_project_total_hour'])->name('report_project_total_hour');


//AdminLeave
Route::get('/all_leave', [AdminLeaveController::class, 'all_leave'])->name('all_leave');
Route::get('/all_leavelist', [AdminLeaveController::class, 'all_leavelist'])->name('all_leavelist');
Route::get('/all_leavestatus/{id}', [AdminLeaveController::class, 'all_leavestatus'])->name('all_leavestatus');
Route::get('/all_leaveview/{id}', [AdminLeaveController::class, 'all_leaveview'])->name('all_leaveview');

//Admin Report
Route::get('/admin_report_attendance', [AdminReportsController::class, 'admin_report_attendance'])->name('admin_report_attendance');
Route::get('/admin_report_attendancelist', [AdminReportsController::class, 'admin_report_attendancelist'])->name('admin_report_attendancelist');
Route::get('/admin_report_daily_work_entry', [AdminReportsController::class, 'admin_report_daily_work_entry'])->name('admin_report_daily_work_entry');
Route::get('/admin_report_project_total_hour', [AdminReportsController::class, 'admin_report_project_total_hour'])->name('admin_report_project_total_hour');
Route::get('/employee_summary', [AdminReportsController::class, 'employee_summary'])->name('employee_summary');
Route::get('/project_summary', [AdminReportsController::class, 'project_summary'])->name('project_summary');
Route::get('/project_history', [AdminReportsController::class, 'project_history'])->name('project_history');


});




/*Route::get('/', function () {
    return view('Client.Dashboard.index');
});*/

Route::get('/Dashboard', function () {
    return view('Client.Dashboard.index');
});

Route::get('/admin', function () {
    return view('Admin.Dashboard.index');
});

Route::get('AddTechnology', function () {
    return view('Client.Technology.add');
});

Route::post('/AddTechnology',[TechnologyController::class,'AddTech']);

Route::get('edit_tech/{id}',[TechnologyController::class,'Edit']);
Route::post('update-technology/{id}',[TechnologyController::class,'Update']);

Route::get('Technology', [TechnologyController::class, 'index']);
Route::get('Technology/list', [TechnologyController::class, 'ShowTech'])->name('Technology.list');

Route::get('/Project',[ProjectController::class,'ShowProject']);
Route::get('Project/list', [ProjectController::class, 'DispProject'])->name('Project.list');

Route::get('/completeproject',[ProjectController::class,'CompletProject']);    //complete project checkbox

Route::get('AddProject',[ProjectController::class,'InsertProject']);
Route::post('AddProject',[ProjectController::class,'Addproject']);

Route::get('edit_project/{id}',[ProjectController::class,'EditProject']);
Route::post('update-project/{id}',[ProjectController::class,'Update']);

Route::get('delete_project/{id}',[ProjectController::class,'Delete']);

Route::get('/ProjectAllotment',[ProjectAllotmentController::class,'dispPAllot']);
Route::get('ProjectAllotment/list', [ProjectAllotmentController::class, 'PAllotment'])->name('ProjectAllotment.list');

Route::get('AddAllotment',[ProjectAllotmentController::class,'InsertPAllotment']);
Route::post('AddAllotment',[ProjectAllotmentController::class,'AddPAllotment']);

Route::get('getprojectnm',[ProjectAllotmentController::class,'getPTechnology']); // get technology based on projectname

Route::get('delete_PAllotment/{id}',[ProjectAllotmentController::class,'Delete']);

Route::get('Attendance',[AttendanceController::class,'Attendance']);

Route::get('addatendance',[AttendanceController::class,'AddAttendance']);
Route::get('outatendance',[AttendanceController::class,'OutAttendance']);
Route::get('workhour',[AttendanceController::class,'WorkHours']);

// Routes (Admin Side)

Route::get('AdminTechnology', [TechnologyController::class, 'Adminindex']);
Route::get('AdminTechnology/list', [TechnologyController::class, 'AdminShowTech'])->name('AdminTechnology.list');

Route::get('adminAddTechnology', function () {
    return view('Admin.Technology.add');
});
Route::post('/adminAddTechnology',[TechnologyController::class,'addTechnology']);

Route::get('admin_EditTech/{id}',[TechnologyController::class,'editTechnology']);
Route::post('update-technology/{id}',[TechnologyController::class,'UpdateTechnology']);

Route::get('/AdminProject',[ProjectController::class,'adminProject']);
Route::get('AdminProject/list', [ProjectController::class, 'DispAdminProject'])->name('AdminProject.list');

Route::get('adminAddProject',[ProjectController::class,'adminInsertProject']);
Route::post('adminAddProject',[ProjectController::class,'adminAddproject']);

Route::get('admin_Editproject/{id}',[ProjectController::class,'adminEditProject']);
Route::post('admin_updateproject/{id}',[ProjectController::class,'adminUpdate']);

Route::get('admin_DeleteProject/{id}',[ProjectController::class,'adminDelete']);

Route::get('/AdminProjectAllotment',[ProjectAllotmentController::class,'adminPAllotment']);
Route::get('AdminProjectAllotment/list', [ProjectAllotmentController::class, 'dispPAllotment'])->name('AdminProjectAllotment.list');

Route::get('adminAddAllotment',[ProjectAllotmentController::class,'adminInsertPAllotment']);
Route::post('adminAddAllotment',[ProjectAllotmentController::class,'adminAddPAllotment']);

Route::get('admingetprojectnm',[ProjectAllotmentController::class,'admingetPTechnology']); // get technology based on projectname

Route::get('admindelete_PAllotment/{id}',[ProjectAllotmentController::class,'DeleteAllotment']);