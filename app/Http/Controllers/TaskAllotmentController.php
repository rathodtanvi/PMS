<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllotment;
use App\Models\TaskAllotment;
use App\Models\Project;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use App\Http\Requests\TaskAllotmentRequest;

class TaskAllotmentController extends Controller
{
  public function index()
  {
    $task=TaskAllotment::all();
    $rating=Rating::where('user_id',Auth::id())->pluck('star_rated','task_id')->toarray();
   // dd($rating);
    return view('TaskAllotment.index',compact('rating','task'));
  }
    public function create()
    {
        // if(Auth::user()->roles_id ==1)
        // {
        //   $project=Project::pluck('project_name','id')->toarray();
        //   // dd($project);
        // }
        // else if(Auth::user()->roles_id == 2)
        // {
        //   $allotment=ProjectAllotment::where('user_id',Auth::id())->pluck('project_id')->toArray();
        //   $project=Project::select('id','project_name')->where('tl_id',Auth::id())->orWhereIn('id', $allotment)->pluck('project_name','id')->toarray();
        //   //dd($project);
        // }
        //  else
        //  {
        //     $allotment = ProjectAllotment::where('user_id',Auth::id())->pluck('project_id')->toArray();
        //     $project = Project::select('id','project_name')->whereIn('id', $allotment)->pluck('project_name','id')->toarray(); 
        //     //dd($project);
        //  }
         $allotment = ProjectAllotment::where('user_id',Auth::id())->pluck('project_id')->toArray();
         $project = Project::select('id','project_name')->whereIn('id', $allotment)->pluck('project_name','id')->toarray(); 
        return view('TaskAllotment.add',compact('project'));
    }
    public function store(TaskAllotmentRequest $request)
    {
     
      $task=new TaskAllotment();
      // if($request->user_id)
      // {
      //   $task->user_id=$request->user_id;
      // }
      // elseif($request->user_id == '' && Auth::user()->roles_id == 2)
      // {
      //   $task->user_id=Auth::id();
      // }
      // else
      // {
      //   $task->user_id=0;
      // }
    
      //$task->user_id=$request->user_id;
      //$task->tl_id=Auth::id();
      $task->user_id=Auth::id();
      $task->project_id = $request->project_id; 
      $task->title = $request->title; 
      $task->days_txt = $request->days_txt; 
      $task->hours_txt = $request->hours_txt; 
      $task->description=$request->description;
      $task->status=0;
      $task->save();                                                                       
      return redirect('TaskAllotment')->with('status', 'Successfully Inserted TaskAllotment');                           
    }            
   
    public function getdata(Request $request)
    {
    
      if ($request->ajax()) {
        // if(Auth::user()->roles_id == 1)
        // { 
        //   $data=TaskAllotment::latest()->get();
        //   $data=TaskAllotment::where('tl_id',Auth::id())->latest()->get();
        // }
        // elseif(Auth::user()->roles_id == 2)
        // {

        //   $data=TaskAllotment::where('tl_id',Auth::id())->latest()->get();
        // }
        // else
        // {
        //   $data=TaskAllotment::where('user_id',Auth::id())->latest()->get();
        // }   
        $data=TaskAllotment::where('user_id',Auth::id())->latest()->get();
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
                        //   if(Auth::user()->roles_id != 3 && $row->user_id != $row->tl_id)
                        //   {
                        //   $btn = $btn.'<button class="fa fa-star star star1 btn btn-warning btn-sm m-1   "data-toggle="modal" data-target="#exampleModalCenter"  data-id="'.$row->id.'"></button><br/>';
                        //   //$btn = $btn.'<button class="star">Star</button><br/>';
                        
                        // }  
                          return $btn;
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
                  ->rawColumns(['action','description'])
                  ->make(true);
        }
    }

    public function taskdelete($id)
    {
       TaskAllotment::find($id)->delete();
       return redirect()->back()->with('status', 'Successfully deleted Task');  
    }
    public function taskcomplete(Request $request,$id)
    {
      $user = TaskAllotment::find($id);
      $user->status=1;
      $user->save();
      return redirect('TaskAllotment')->with('status', 'Successfully completed TaskAllotment');
    }

    //  public function empname(Request $request)
    //  {
    //   $data['employeename']=ProjectAllotment::where('project_id',$request->project_id)->pluck('user_id');
    //   $data['user']=User::whereIn('id', $data['employeename'])->get(); 
    //   return response()->json($data);
    //  }

     
    //  public function emptl(Request $request)
    //  {
    //   dd("hello");
    //   $data['employeename']=ProjectAllotment::where('project_id',$request->project_id)->pluck('user_id');
    //   $data['user']=User::whereIn('id', $data['employeename'])->get();   
    //   dd($data['user']);          
    //   return response()->json($data);
    //  }


    public function rating(Request $request,$id)
    {
     
      $taskid=$request->input('taskid');
      if(Rating::where('user_id',Auth::id())->where('task_id',$taskid)->exists())
      {
      $taskid=$request->input('taskid');
      $rating=$request->input('ratingvalue');
      $rate=Rating::where('user_id',Auth::id())->where('task_id',$taskid)->first();
      $rate->user_id=Auth::id();
      $rate->task_id=$request->input('taskid');
      $rate->star_rated=$rating;
      $rate->update();
      return response()->json([
          'update'=>true,
      ]);
    }
       else
       {   
      $rating=$request->input('ratingvalue');
      $rate=new Rating();
      $rate->user_id=Auth::id();
      $rate->task_id=$request->input('taskid');
      $rate->star_rated=$rating;
      $rate->save();
      return response()->json([
        'status'=>true,
    ]);
    
  }
} 
 

   public function ratingdisplay(Request $request,$id)
   {
     dd("hello");
      dd($request->input('taskid'));
   }
   public function show($id)
   {
    
   }
}
