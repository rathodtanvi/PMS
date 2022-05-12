<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\DailyWorkEntryController;
use App\Http\Controllers\EmployeeController;
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
Route::get('/leavestatus', [LeaveController::class, 'leavestatus'])->name('leavestatus');
Route::get('/leaveview/{id}', [LeaveController::class, 'leaveview'])->name('leaveview');


//AdminLeave
Route::get('/all_leave', [LeaveController::class, 'all_leave'])->name('all_leave');
Route::get('/all_leavelist', [LeaveController::class, 'all_leavelist'])->name('all_leavelist');
});