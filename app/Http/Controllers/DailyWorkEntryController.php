<?php

namespace App\Http\Controllers;
use App\Models\DailyWorkEntry;
use App\Models\Project;
use App\Models\ProjectAllotment;
use App\Models\User;
use App\Http\Requests\DailyworkentryRequest;
use Illuminate\Support\Facades\Auth;
use Hash;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class DailyWorkEntryController extends Controller
{
    public function index()
    {
        return view('DailyWorkEntry.index');
    }
    public function create()
    {
        $project=ProjectAllotment::where('user_id',Auth::id())->get();
        return view('DailyWorkEntry.add',compact('project'));
    }
    public function store(DailyworkentryRequest $request)
    {
      $hours=$request->entry_duration_hours;
      $minutes=$request->entry_duration_minutes;
      $data= [
        $hours,
        $minutes,
      ];
      $work=new DailyWorkEntry();
      $work->user_id=Auth::id();
      $work->project_id = $request->project_id; 
      $work->entry_date=$request->entry_date;
      $work->entry_duration=implode(':',$data);
      $work->productive=$request->productive;
      $work->work_type=$request->work_type;
      $work->description=$request->description;
      $work->save();
      return redirect('DailyWorkEntry')->with('status', 'Successfully Inserted Work Entry');
    }

    public function edit($id)
    {
        $work=User::where('roles_id','3')->get();
        $datas=DailyWorkEntry::find($id);
        return view('DailyWorkEntry.edit',compact('datas','work'));
    }
    public function update(DailyworkentryRequest $request,$id)
    {
      $hours=$request->entry_duration_hours;
      $minutes=$request->entry_duration_minutes;
      $data= [
        $hours,
        $minutes,
      ];
      $updatework=DailyWorkEntry::find($id);
      $updatework->user_id=Auth::id();
      $updatework->project_id = $request->project_id; 
      $updatework->entry_date=$request->entry_date;
      $updatework->entry_duration=implode(':',$data);
      $updatework->productive=$request->productive;
      $updatework->work_type=$request->work_type;
      $updatework->description=$request->description;
      $updatework->update();
      return redirect('DailyWorkEntry')->with('status', 'Successfully Update Work Entry');;
    }
   
    public function getdata(Request $request)
    {
      if ($request->ajax()) {
        $data=DailyWorkEntry::with('project')->where('user_id',Auth::id())->latest()->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="'.route('DailyWorkEntry.edit',$row->id).'"  class=" edit btn btn-primary btn-sm m-1">Edit</a>';
                        $btn = $btn.'<a href="'.route('delete',$row->id).'" class="edit btn btn-danger btn-sm m-1">Delete</a>';
                        return $btn;
                })
                ->addColumn('project_id',function(DailyWorkEntry $project_id){
                    return $project_id->project->project_name;
                })
                ->rawColumns(['action','description'])
                ->make(true);
    }
      // return view('User.daily_work_entry');
    }
   public function delete($id)
    {
        DailyWorkEntry::find($id)->delete();
          return redirect('DailyWorkEntry')->with('status', 'Successfully Delete Work Entry');;
    }
   
    
}
