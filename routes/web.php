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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TaskAllotmentController;
use App\Http\Controllers\ProjectMilestoneController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () { 

//HomeController
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/myprofile', [HomeController::class, 'myprofile'])->name('myprofile');
Route::put('/updateprofile/{id}', [HomeController::class, 'updateprofile'])->name('updateprofile');
Route::post('/changepassword', [HomeController::class, 'changepassword'])->name('changepassword');
Route::get('/getdata_employeelist', [HomeController::class, 'getdata'])->name('getdata_employeelist');
Route::get('/overview', [HomeController::class, 'overview'])->name('overview');


//EmployeeController
Route::get('/getdata_employee', [EmployeeController::class, 'getdata'])->name('getdata_employee');
Route::get('/status/{id}', [EmployeeController::class, 'status'])->name('status');
Route::get('/changerole/{id}', [EmployeeController::class, 'changerole'])->name('changerole');
Route::resource('/employee',EmployeeController::class);

//Holiday Controller
Route::resource('/Holiday',HolidayController::class);
Route::get('getdata_holiday', [HolidayController::class, 'getdata'])->name('getdata_holiday');
Route::get('/delete_holiday/{id}', [HolidayController::class, 'delete'])->name('delete_holiday');

//DailyWorkEntry
Route::get('/getdata_dailyworkentry', [DailyWorkEntryController::class, 'getdata'])->name('getdata_dailyworkentry');
Route::get('/delete/{id}', [DailyWorkEntryController::class, 'delete'])->name('delete');
Route::resource('/DailyWorkEntry',DailyWorkEntryController::class);


//Leave Controller
Route::get('/getdata_leave', [LeaveController::class, 'getdata'])->name('getdata_leave');
Route::get('/leavestatus/{id}', [LeaveController::class, 'leavestatus'])->name('leavestatus');
//TL Leave
Route::get('/all_leavelist', [LeaveController::class, 'all_leavelist'])->name('all_leavelist');
Route::get('/all_leavestatus/{id}', [LeaveController::class, 'all_leavestatus'])->name('all_leavestatus');
Route::get('/all_leaveview/{id}', [LeaveController::class, 'all_leaveview'])->name('all_leaveview');
Route::resource('/leave',LeaveController::class);


//Task_Allotment Controller
Route::get('/getdata_taskallotment', [TaskAllotmentController::class, 'getdata'])->name('getdata_taskallotment');
Route::get('/taskcomplete/{id}', [TaskAllotmentController::class, 'taskcomplete'])->name('taskcomplete');
Route::get('/taskdelete/{id}', [TaskAllotmentController::class, 'taskdelete'])->name('taskdelete');
//Route::post('/empname', [TaskAllotmentController::class, 'empname'])->name('empname');
// Route::post('/emptl', [TaskAllotmentController::class, 'emptl'])->name('emptl');
// Route::get('/rating', [TaskAllotmentController::class, 'rating'])->name('rating');
// Route::get('/rating/{id}', [TaskAllotmentController::class, 'rating'])->name('rating');
Route::resource('/TaskAllotment',TaskAllotmentController::class);


Route::get('/ratingdisplay/{id}', [TaskAllotmentController::class, 'ratingdisplay'])->name('ratingdisplay');
Route::resource('/TaskAllotment',TaskAllotmentController::class);
Route::get('/rating/{id}', [TaskAllotmentController::class, 'rating'])->name('rating');

Route::get('/reviewadd', [TaskAllotmentController::class, 'AddReview']);  //Task review Button
Route::get('reviewupd', [TaskAllotmentController::class, 'task_allotment']);


// Project Milestones 
Route::get('/ProjectMilestones', [ProjectMilestoneController::class, 'index']);


//Reports Controller
Route::get('/report_attendance', [ReportsController::class, 'report_attendance'])->name('report_attendance');
Route::get('/report_attendancelist', [ReportsController::class, 'report_attendancelist'])->name('report_attendancelist');
Route::get('/report_project_total_hour', [ReportsController::class, 'report_project_total_hour'])->name('report_project_total_hour');
Route::get('/report_attendancetotal', [ReportsController::class, 'report_attendancetotal'])->name('report_attendancetotal');
Route::post('/total_hour', [ReportsController::class, 'total_hour'])->name('total_hour');

Route::get('/report_daily_work_entry', [ReportsController::class, 'report_daily_work_entry'])->name('report_daily_work_entry');
Route::get('getproject',[ReportsController::class,'getproject']); // get project based on project_status
Route::get('get_technology',[ReportsController::class,'get_technology']); // get technology based on project_name
Route::get('/report_dailyworklist', [ReportsController::class, 'report_dailyworklist'])->name('report_dailyworklist');
Route::get('/report_dailyworktotal', [ReportsController::class, 'report_dailyworktotal'])->name('report_dailyworktotal');
Route::get('get_alluser',[ReportsController::class,'report_dailyworklist']);

Route::get('/pdf-download',[ReportsController::class,'pdf_file']);

//Admin Report
Route::get('/admin_report_attendance', [AdminReportsController::class, 'admin_report_attendance'])->name('admin_report_attendance');
Route::get('/admin_report_attendancelist', [AdminReportsController::class, 'admin_report_attendancelist'])->name('admin_report_attendancelist');
Route::get('/admin_report_daily_work_entry', [AdminReportsController::class, 'admin_report_daily_work_entry'])->name('admin_report_daily_work_entry');
Route::get('/admin_report_project_total_hour', [AdminReportsController::class, 'admin_report_project_total_hour'])->name('admin_report_project_total_hour');
Route::get('/employee_summary', [AdminReportsController::class, 'employee_summary'])->name('employee_summary');
Route::get('/project_summary', [AdminReportsController::class, 'project_summary'])->name('project_summary');
Route::get('/project_history', [AdminReportsController::class, 'project_history'])->name('project_history');


//Technology  Controller
Route::get('getdata', [TechnologyController::class, 'getdata'])->name('getdata');
Route::resource('/Technology',TechnologyController::class);
});


//Attendance Controller
Route::get('addatendance',[AttendanceController::class,'AddAttendance']);
Route::get('outatendance',[AttendanceController::class,'OutAttendance']);
Route::get('workhour',[AttendanceController::class,'WorkHours']);
Route::resource('/Attendance',AttendanceController::class);

//Project
Route::resource('/project', ProjectController::class);
Route::get('Project/getdata', [ProjectController::class, 'getdata'])->name('Project.getdata');
Route::get('statuschange',[ProjectController::class,'statuschange']);

//Project Allotment
Route::resource('/projectAllotement', ProjectAllotmentController::class);
Route::get('ProjectAllotment/getdata', [ProjectAllotmentController::class, 'getdata'])->name('ProjectAllotment.getdata');
Route::get('gettechnology',[ProjectAllotmentController::class,'gettechnology']); // get technology based on projectname
Route::get('destroy/{id}',[ProjectAllotmentController::class,'destroy']);

// Route::get('/Dashboard', function () {
//     return view('Client.Dashboard.index');
// });

// Route::get('/admin', function () {
//     return view('Admin.Dashboard.index');
// });

// Route::get('AddTechnology', function () {
//     return view('Client.Technology.add');
// });


//Route::get('/Project',[ProjectController::class,'ShowProject'])->name('Project');
//Route::get('Project/list', [ProjectController::class, 'DispProject'])->name('Project.list');

// Route::get('/completeproject',[ProjectController::class,'CompletProject']);    //complete project checkbox

// Route::get('AddProject',[ProjectController::class,'InsertProject']);
// Route::post('AddProject',[ProjectController::class,'Addproject']);

// Route::get('edit_project/{id}',[ProjectController::class,'EditProject']);
// Route::post('update-project/{id}',[ProjectController::class,'Update']);

// Route::get('delete_project/{id}',[ProjectController::class,'Delete']);

// /*Route::get('/ProjectAllotment',[ProjectAllotmentController::class,'dispPAllot']);
// Route::get('ProjectAllotment/list', [ProjectAllotmentController::class, 'PAllotment'])->name('ProjectAllotment.list');*/



// Route::get('delete_PAllotment/{id}',[ProjectAllotmentController::class,'Delete']);


// Routes (Admin Side)


// Route::get('/Project',[ProjectController::class,'adminProject']);
// Route::get('Project/list', [ProjectController::class, 'DispAdminProject'])->name('Project.list');

// Route::get('AddProject',[ProjectController::class,'adminInsertProject']);
// Route::post('AddProject',[ProjectController::class,'adminAddproject']);

// Route::get('Editproject/{id}',[ProjectController::class,'adminEditProject']);
// Route::post('update-project/{id}',[ProjectController::class,'adminUpdate']);

// Route::get('DeleteProject/{id}',[ProjectController::class,'adminDelete']); 

// Route::get('/completeproject',[ProjectController::class,'CompletProject']); 

// /*Route::get('/ProjectAllotment',[ProjectAllotmentController::class,'adminPAllotment']);
// Route::get('ProjectAllotment/list', [ProjectAllotmentController::class, 'dispPAllotment'])->name('ProjectAllotment.list');*/

// Route::get('AddAllotment',[ProjectAllotmentController::class,'adminInsertPAllotment']);
// Route::post('AddAllotment',[ProjectAllotmentController::class,'adminAddPAllotment']);

// Route::get('admingetprojectnm',[ProjectAllotmentController::class,'admingetPTechnology']); // get technology based on projectname

// Route::get('delete_PAllotment/{id}',[ProjectAllotmentController::class,'DeleteAllotment']);