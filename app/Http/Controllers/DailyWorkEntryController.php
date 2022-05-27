<?php

namespace App\Http\Controllers;
use App\Models\DailyWorkEntry;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Hash;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class DailyWorkEntryController extends Controller
{
    public function daily_work_entry()
    {

        return view('User.DailyWorkEntry.index');
    }
    
    public function daily_work_entrylist(Request $request)
    {
      if ($request->ajax()) {
        $data=DailyWorkEntry::where('user_id',Auth::id())->latest()->get();
        //$work = DailyWorkEntry::latest()->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="'.route('workedit',$row->id).'"  class=" btn btn-info btn-sm m-1">Edit</a>';
                        $btn = $btn.'<a href="'.route('workdelete',$row->id).'" class="edit btn btn-danger btn-sm m-1">Delete</a>';
                        return $btn;
                })
                ->addColumn('description',function(DailyWorkEntry $des){
                  return Strip_tags($des->description);
                })
                ->addColumn('project_id',function(DailyWorkEntry $project_id){
                    return $project_id->project->Project_Name;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
      // return view('User.daily_work_entry');
    }
    public function enter_daily_work_entry(Request $request)
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
      return redirect('daily_work_entry');
    }
    public function addwork()
    {
        $project=Project::all();
        return view('User.DailyWorkEntry.add',compact('project'));
    }
    public function workedit($id)
    {
        $datas=DailyWorkEntry::find($id);
        return view('User.DailyWorkEntry.edit',compact('datas'));
    }
    public function workupdate(Request $request,$id)
    {
      $hours=$request->entry_duration_hours;
      $minutes=$request->entry_duration_minutes;
      $data= [
        $hours,
        $minutes,
      ];
      $project_id="1";
      $updatework=DailyWorkEntry::find($id);
      $updatework->user_id=Auth::id();
      $updatework->project_id = $project_id; 
      $updatework->entry_date=$request->entry_date;
      $updatework->entry_duration=implode(':',$data);
      $updatework->productive=$request->productive;
      $updatework->work_type=$request->work_type;
      $updatework->description=$request->description;
      $updatework->update();
      return redirect('daily_work_entry');
    }
    public function workdelete($id)
    {
        DailyWorkEntry::find($id)->delete();
        return redirect()->back();
    }
}
