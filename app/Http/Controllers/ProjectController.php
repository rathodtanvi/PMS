<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function ShowProject()
    {
        return view('Project.index');
    }

    public function DispProject(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::get();
            
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="checkbox" value="'.$item->id.'" name="chk[]" onclick="checkboxchecked(this)"/>';
                })
                ->addColumn('action', function($row){
                    if($row->Complete_Project == "Complete")
                    {
                        $actionBtn = "<a href='edit_project/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='delete_project/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> <i class='bi bi-check-circle'></i> </div>";
                    }
                    else
                    {
                        $actionBtn = "<a href='edit_project/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='delete_project/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> </div>";
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function InsertProject()
    {
        $technology = Technology::get();
        return view('Project.add',compact('technology'));
    }
    public function Addproject(Request $request)
    {

        $check = Project::where("project_name","=",$request['projectnm'])->pluck('Project_Name')->toArray();
        
        if(in_array($request['projectnm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Project Name Already exist.']);
        }
        else
        {
            $tech = new Project;
            $tech->project_name = $request['projectnm'];
            $tech->technology_name = implode(' , ', $request->technm);
            $tech->save();

            return redirect('Project');
        }
    }

    public function EditProject($id)
    {
        $technology = Technology::get();
        $edits = Project::find($id);
        
        return view("Project.edit",compact('edits','technology'));
        
    }

    public function Update(Request $request,$id)
    {
        $update = Project::find($id);
        $update->project_name = $request->input('projectnm');
        $update->technology_name = implode(',', $request->technm);
        
        $update->update();
        return redirect('Project');
    }

    public function Delete($id)
    {
        $delete = Project::find($id)->delete();
        return redirect()->back();
    }

    public function CompletProject()
    {
        $getid = $_GET['id'];

        $update = Project::find($getid);
        $update->Complete_Project = "Complete";
        $update->update();

        return redirect('Project');
    }


    /* -------------------------------- */
    /* Admin side Technology Controller */


    public function adminProject()
    {
        return view('Project.index');
    }

    public function DispAdminProject(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::get();
            
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="checkbox" value="'.$item->id.'" name="chk[]" onclick="checkboxchecked(this)" />';
                })
                ->addColumn('action', function($row){
                    if($row->Complete_Project == "Complete")
                    {
                        $actionBtn = "<a href='admin_Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='admin_DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> <i class='bi bi-check-circle'></i> </div>";
                    }
                    else
                    {
                        $actionBtn = "<a href='admin_Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='admin_DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> </div>";
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function adminInsertProject()
    {
        $technology = Technology::get();
        return view('Project.add',compact('technology'));
    }
    public function adminAddproject(Request $request)
    {
        $check = Project::where("project_name","=",$request['projectnm'])->pluck('project_name')->toArray();
        
        if(in_array($request['projectnm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Project Name Already exist.']);
        }
        else
        {
            $tech = new Project;
            $tech->project_name = $request['projectnm'];
            $tech->technology_name = implode(' , ', $request->technm);
            $tech->save();

            return redirect('AdminProject');
        }
    }

    public function adminEditProject($id)
    {
        $technology = Technology::get();
        $edits = Project::find($id);
        
        return view("Project.edit",compact('edits','technology'));
        
    }

    public function adminUpdate(Request $request,$id)
    {
        $update = Project::find($id);
        $update->project_name = $request->input('projectnm');
        $update->technology_name = implode(',', $request->technm);
        
        $update->update();
        return redirect('AdminProject');
    }

    public function adminDelete($id)
    {
        $delete = Project::find($id)->delete();
        return redirect()->back();
    }

}
