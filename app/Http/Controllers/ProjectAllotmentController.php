<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectAllotment;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectAllotmentRequest;

class ProjectAllotmentController extends Controller
{

    public function adminPAllotment()
    {
        return view('Project Allotment.index');
    }

    public function dispPAllotment(Request $request)
    {
        if ($request->ajax()) 
        {
            if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
            {
                $data = ProjectAllotment::with('project')->with('user')->get();
            
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a>";
                    return $actionBtn;
                })
                ->addColumn('technology_id', function ($tid) {
                    $arr = explode(",",$tid->technology_id);
                    $data = Technology::whereIn('id',$arr)->get();
                    
                    foreach($data as $row)
                    {
                        $tdata[] = $row->technology_name;
                    } 
                    return $tdata;                    
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            else
            {
                $data = ProjectAllotment::with('project')->with('user')->where("user_id",'=',Auth::user()->id)->get();
            
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a>";
                    return $actionBtn;
                })
                ->addColumn('technology_id', function ($tid) {
                    $arr = explode(",",$tid->technology_id);
                    $data = Technology::whereIn('id',$arr)->get();
                    
                    foreach($data as $row)
                    {
                        $tdata[] = $row->technology_name;
                        
                    } 
                    return $tdata;                    
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }
    }

    public function admingetPTechnology()
    {
        $nm = $_GET['name'];
        $technology = Project::find($nm);
        $tech = explode(',',$technology->technology_id);
        $data = Technology::whereIn('id',$tech)->get();
        
        return json_encode($data);
    }

    public function adminInsertPAllotment()
    {
        $users = User::get();
        $technology = Technology::get();
        $projects = Project::get();
        
        return view('Project Allotment.add',compact('users','projects','technology'));
    }

    public function adminAddPAllotment(ProjectAllotmentRequest $request)
    {
        if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
        {
            
            $tech = new ProjectAllotment;
            $tech->user_id = $request['unm'];
            $tech->project_id = $request['projectnm'];
            $tech->technology_id = implode(',',$request->technology_id );
            $tech->save();
            
        }
        else
        {
            
            $tech = new ProjectAllotment;
            $tech->user_id = Auth::user()->id;
            $tech->project_id = $request['projectnm'];
            $tech->technology_id = implode(',',$request->technology_id );
            
            $tech->save();
            
        }
        
        return redirect('ProjectAllotment');
    }

    public function DeleteAllotment($id)
    {
        $delete = ProjectAllotment::find($id)->delete();
        return redirect()->back();
    }
}