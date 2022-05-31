<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\TaskAllotment;
use App\Models\Project  ;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TaskAllotmentController extends Controller
{
    public function add_task()
    {
        $employee=User::where('roles_id','!=','1')->where('roles_id','!=','2')->get();
        $project=ProjectAllotment::where('user_id',Auth::id())->get();
        $allproject=Project::all();
        return view('TaskAllotment.add',compact('project','employee','allproject'));
    }
    public function enter_task(Request $request)
    {
      $task=new TaskAllotment();
      if($request->emp_name)
      {
        $task->user_id=$request->emp_name;
      }
      elseif($request->emp_name == '')
      {
        $task->user_id=Auth::id();
      }
      else
      {
        $task->user_id=Auth::id();
      }
      $task->project_id = $request->project_id; 
      $task->title = $request->title; 
      $task->days_txt = $request->days_txt; 
      $task->hours_txt = $request->hours_txt; 
      $task->description=$request->description;
      $task->save();
      return redirect('task_allotment');
    }
    public function task_allotment()
    {
        return view('TaskAllotment.index');
    }
    public function task_allotment_list(Request $request)
    {
      if ($request->ajax()) {
        $data=TaskAllotment::where('user_id',Auth::id())->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="'.route('taskedit',$row->id).'"  class=" edit btn btn-primary btn-sm m-1">Edit</a>';
                        $btn = $btn.'<a href="'.route('taskdelete',$row->id).'" class="edit btn btn-danger btn-sm m-1">Delete</a>';
                        return $btn;
                })
                ->addColumn('description',function(TaskAllotment $des){
                  return Strip_tags($des->description);
                })
                ->addColumn('project_id',function(TaskAllotment $project_id){
                    return $project_id->project->project_name;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
      // return view('User.daily_work_entry');
    }
}
