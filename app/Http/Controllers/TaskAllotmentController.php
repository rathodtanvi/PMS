<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\TaskAllotment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TaskAllotmentRequest;

class TaskAllotmentController extends Controller
{
    public function add_task()
    {
  
        if(Auth::user()->roles_id ==1)
        {
          $project=Project::pluck('project_name','id')->toarray();
          // dd($project);
        }
        else if(Auth::user()->roles_id == 2)
        {

          $allotment=ProjectAllotment::where('user_id',Auth::id())->pluck('project_id')->toArray();
          $project=Project::select('id','project_name')->where('tl_id',Auth::id())->orWhereIn('id', $allotment)->pluck('project_name','id')->toarray();
          //dd($project);
        }
         else
         {
            $allotment = ProjectAllotment::where('user_id',Auth::id())->pluck('project_id')->toArray();
            $project = Project::select('id','project_name')->whereIn('id', $allotment)->pluck('project_name','id')->toarray(); 
           // dd($project);
         }
        return view('TaskAllotment.add',compact('project'));
    }
    public function enter_task(TaskAllotmentRequest $request)
    {
      $task=new TaskAllotment();
      if($request->user_id)
      {
        $task->user_id=$request->user_id;
      }
      elseif($request->user_id == '')
      {
        $task->user_id=Auth::id();
      }
     if(Auth::user()->roles_id ==1)
     {
       $task->user_id=0;
     }
      //$task->user_id=$request->user_id;
      $task->tl_id=Auth::id();
      $task->project_id = $request->project_id; 
      $task->title = $request->title; 
      $task->days_txt = $request->days_txt; 
      $task->hours_txt = $request->hours_txt; 
      $task->description=$request->description;
      $task->status=0;
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
          $data=TaskAllotment::latest()->get();
        }
        elseif(Auth::user()->roles_id == 2)
        {
          $data=TaskAllotment::where('tl_id',Auth::id())->get();
        }
        else
        {
          $data=TaskAllotment::where('user_id',Auth::id())->latest()->get();
        }   
       
          return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                         if($row->status == 1)
                         {
                          $btn = '<a class="fa fa-check  btn btn-success btn-sm m-1" style="color:white"></a>';
                         }
                         else
                         {
                          $btn = '<a href="'.route('taskcomplete',$row->id).'"class="fa fa-check  btn btn-primary btn-sm m-1"></a>';
                         }    
                          $btn = $btn.'<a href="'.route('taskdelete',$row->id).'" class="fa fa-trash btn btn-danger btn-sm m-1"></a><br/>';
                          $btn = $btn.'<a href="'.route('rating',$row->id).'" class=" btn btn-warning btn-sm m-1">rating</a><br/>';
                         
                          return $btn;
                         })
                  ->addColumn('description',function(TaskAllotment $des){
                     $des =Strip_tags($des->description);
                     return str_replace('&nbsp;','',$des);
                  })
                  ->addColumn('tl_id',function(TaskAllotment $tl_id){
                    return $tl_id->username->name;
                  })
                  ->addColumn('project_name',function(TaskAllotment $project_name){
                    return $project_name->projectallotment->project->project_name;
                  })
                  ->addColumn('employeename',function(TaskAllotment $emp){
                     if($emp->user_id == 0)
                     {
                       return '';
                     }
                     else
                     {
                      return $emp->user->name;
                     }
                  
                })
                ->addColumn('days_txt',function(TaskAllotment $days){
                  if($days->hours_txt == '')
                  {
                    return $days->days_txt;
                  }
                  else
                  {
                     $data=$days->hours_txt/8;
                    return round($data,1);
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

    public function rating($id)
    {
        return view('TaskAllotment.rating');
    }
    
}
