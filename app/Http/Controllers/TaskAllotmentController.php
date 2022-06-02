<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\TaskAllotment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TaskAllotmentController extends Controller
{
    public function add_task()
    {
        //$employee=User::where('roles_id','!=','1')->where('roles_id','!=','2')->get();
       // $emp=User::where('roles_id','!=','1')->get();
        $project=Project::pluck('id');
        $projectAllotment=ProjectAllotment::pluck('project_id');
       
        $project=ProjectAllotment::where('user_id',Auth::id())->get();
        $pros=Project::where('user_id',Auth::id())->get(); 
        $allproject=Project::all();
        return view('TaskAllotment.add',compact('project','allproject','pros'));
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
        if(Auth::user()->roles_id == 1)
        {
          $data=TaskAllotment::all();
          return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                         if($row->status == 1)
                         {
                          $btn = '<a class="fa fa-check  btn btn-success btn-sm m-1" style="color:white"></a>';
                         }
                         else
                         {
                          $btn = '<a href="'.route('taskcomplete',$row->id).'"  class="fa fa-check  btn btn-primary btn-sm m-1"></a>';
                         }
                          $btn = $btn.'<a href="'.route('taskdelete',$row->id).'" class="fa fa-trash btn btn-danger btn-sm m-1"></a>';
                          return $btn;
                  })
                  ->addColumn('description',function(TaskAllotment $des){
                    return Strip_tags($des->description);
                  })
                  ->addColumn('project_id',function(TaskAllotment $project_id){
                      return $project_id->project->project_name;
                  })
                  ->addColumn('employeename',function(TaskAllotment $emp){
                    return $emp->user->name;
                })
                ->addColumn('days_txt',function(TaskAllotment $days){
                  if($days->hours_txt == '')
                  {
                    return $days->days_txt;
                  }
                  else
                  {
                     $data=$days->hours_txt/8;
                    return round($data,2);
                  }
                 })
                 ->addColumn('hours_txt',function(TaskAllotment $hours){
                  if($hours->hours_txt == '')
                  {
                    return  $hours->days_txt*8;
                  }
                  else{
                    return $hours->hours_txt;
                  }
              })
                  ->rawColumns(['action'])
                  ->make(true);
        }
        else{

        $data=TaskAllotment::where('user_id',Auth::id())->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                  if($row->status == 1)
                  {
                   $btn = '<a class="fa fa-check  btn btn-success btn-sm m-1" style="color:white"></a>';
                  }
                  else
                  {
                   $btn = '<a href="'.route('taskcomplete',$row->id).'"  class="fa fa-check  btn btn-primary btn-sm m-1"></a>';
                  }
                        $btn = $btn.'<a href="'.route('taskdelete',$row->id).'" class="fa fa-trash btn btn-danger btn-sm m-1"></a>';
                        return $btn;
                })
                ->addColumn('description',function(TaskAllotment $des){
                  return Strip_tags($des->description);
                })
                ->addColumn('project_id',function(TaskAllotment $project_id){
                    return $project_id->project->project_name;
                })
                ->addColumn('employeename',function(TaskAllotment $emp){
                  return $emp->user->name;
              })
                ->addColumn('days_txt',function(TaskAllotment $days){
                  if($days->hours_txt == '')
                  {
                    return $days->days_txt;
                  }
                  else
                  {
                     $data=$days->hours_txt/8;
                     return round($data,2);
                  }
                 })
                 ->addColumn('hours_txt',function(TaskAllotment $hours){
                  if($hours->hours_txt == '')
                  {
                    return  $hours->days_txt*8;
                  }
                  else{
                    return $hours->hours_txt;
                  }
              })
                ->rawColumns(['action'])
                ->make(true);
        }
      }
    }

    public function taskdelete($id)
    {
       TaskAllotment::find($id)->delete();
       return redirect()->back();
    }
    public function taskcomplete(Request $request,$id)
    {
      $user = TaskAllotment::find($id);
      $user->status=1;
      $user->save();
      return redirect('task_allotment');
    }

     public function empname(Request $request)
     {
      $data['employeename']=ProjectAllotment::where('project_id',$request->project_id)->pluck('user_id');
      $data['user']=User::whereIn('id', $data['employeename'])->get();            
      return response()->json($data);
     }

     
     public function emptl(Request $request)
     {
      $data['employeename']=ProjectAllotment::where('project_id',$request->project_id)->pluck('user_id');
      $data['user']=User::whereIn('id', $data['employeename'])->get();            
      return response()->json($data);
     }


    
}
