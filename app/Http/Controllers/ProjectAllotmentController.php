<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectAllotment;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ProjectAllotmentController extends Controller
{
    public function dispPAllot()
    {
        return view('Client.Project Allotment.index');
    }

    public function PAllotment(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = ProjectAllotment::where("user_nm",'=','Bhavya')->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='delete_PAllotment/".$row['id']."' class='btn-delete'> Delete </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getPTechnology()
    {
        $nm = $_GET['name'];
        $technology = Project::where('Project_Name','=',$nm)->get();
        $getdata = explode(",",$technology[0]->Technology_Name);
        $count = str_word_count($technology[0]->Technology_Name);
    
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

        return view('Client.Project Allotment.add',compact('projects','technology'));
    }

    public function AddPAllotment(Request $request)
    {
        $tech = new ProjectAllotment;
        $tech->user_nm = 'Bhavya';
        $tech->Project_Name = $request['projectnm'];
        $tech->Technology_Name = implode(' , ',$request->technm );
        $tech->save();

        return redirect('http://localhost:8080/API_PMS/public/ProjectAllotment');
    }

    public function Delete($id)
    {
        $delete = ProjectAllotment::find($id)->delete();
        return redirect()->back();
    }


    /* -------------------------------- */
    /* Admin side Technology Controller */


    public function adminPAllotment()
    {
        return view('Admin.Project Allotment.index');
    }

    public function dispPAllotment(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = ProjectAllotment::get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='admindelete_PAllotment/".$row['id']."' class='btn-delete'> Delete </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function admingetPTechnology()
    {
        $nm = $_GET['name'];
        $technology = Project::where('Project_Name','=',$nm)->get();
        $getdata = explode(",",$technology[0]->Technology_Name);
        $count = str_word_count($technology[0]->Technology_Name);
        
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

        return view('Admin.Project Allotment.add',compact('users','projects','technology'));
    }

    public function adminAddPAllotment(Request $request)
    {
        $tech = new ProjectAllotment;
        $tech->user_nm = $request['unm'];
        $tech->Project_Name = $request['projectnm'];
        $tech->Technology_Name = implode(' , ',$request->technm );
        $tech->save();

        return redirect('http://localhost:8080/API_PMS/public/AdminProjectAllotment');
    }

    public function DeleteAllotment($id)
    {
        $delete = ProjectAllotment::find($id)->delete();
        return redirect()->back();
    }
}
