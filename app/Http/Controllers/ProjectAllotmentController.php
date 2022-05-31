<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectAllotment;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ProjectAllotmentController extends Controller
{
    /*public function dispPAllot()
    {
        return view('Project Allotment.index');
    }

    public function PAllotment(Request $request)
    {
        if ($request->ajax()) 
        {

            $data = ProjectAllotment::with('user')->where("user_id",'=',Auth::user()->id)->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getPTechnology()
    {
        $nm = $_GET['name'];
        $technology = Project::where('project_name','=',$nm)->get();
        $getdata = explode(",",$technology[0]->technology_name);
        $count = str_word_count($technology[0]->technology_name);
    
        for($i=0; $i< $count; $i++)
        {
            
            $data[] = $getdata[$i];
        }
        return response()->json($data);
    }

    public function InsertPAllotment()
    {
        $technology = Technology::get();
        $projects = Project::get();

        return view('Project Allotment.add',compact('projects','technology'));
    }

    public function AddPAllotment(Request $request)
    {
        
        $tech = new ProjectAllotment;
        $tech->user_id = Auth::user()->id;
        $tech->project_name = $request['projectnm'];
        $tech->technology_name = implode(' , ',$request->technm );
        
        $tech->save();

        return redirect('ProjectAllotment');
    }

    public function Delete($id)
    {
        $delete = ProjectAllotment::find($id)->delete();
        return redirect()->back();
    }*/


    /* -------------------------------- */
    /* Admin side Technology Controller */


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
                $data = ProjectAllotment::with('user')->get();
            
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            else
            {
                $data = ProjectAllotment::with('user')->where("user_id",'=',Auth::user()->id)->get();
            
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }
    }

    public function admingetPTechnology()
    {
        $nm = $_GET['name'];
        $technology = Project::where('project_name','=',$nm)->get();
        $getdata = explode(",",$technology[0]->technology_name);
    
        $str = str_replace(" ","",$technology[0]->technology_name);
        $count = str_word_count($str);
    
        for($i=0; $i< $count; $i++)
        {
            $data[] = $getdata[$i];
        }
        return response()->json($data);
    }

    public function adminInsertPAllotment()
    {
        $users = User::get();
        $technology = Technology::get();
        $projects = Project::get();

        return view('Project Allotment.add',compact('users','projects','technology'));
    }

    public function adminAddPAllotment(Request $request)
    {
        if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
        {
            $tech = new ProjectAllotment;
            $tech->user_id = $request['unm'];
            $tech->project_name = $request['projectnm'];
            $tech->technology_name = implode(' , ',$request->technm );
            $tech->save();
        }
        else
        {
            $tech = new ProjectAllotment;
            $tech->user_id = Auth::user()->id;
            $tech->project_name = $request['projectnm'];
            $tech->technology_name = implode(' , ',$request->technm );
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
