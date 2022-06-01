<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    
    public function adminProject()
    {
        return view('Project.index');
    }

    public function DispAdminProject(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::with("technology")->get();
            
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="checkbox" value="'.$item->id.'" name="chk[]" onclick="checkboxchecked(this)" />';
                })
                ->addColumn('action', function($row){
                    if($row->complete_project == "Complete")
                    {
                        $actionBtn = "<a href='Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> <i class='bi bi-check-circle'></i> </div>";
                    }
                    else
                    {
                        $actionBtn = "<a href='Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> </div>";
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
    public function adminAddproject(ProjectRequest $request)
    {
        
            $tech = new Project;
            $tech->technology_id = implode(",",$request->technology_name);
            $tech->project_name = $request->project_name;
            
            $tech->save();

            return redirect('Project');
    
    }

    public function adminEditProject($id)
    {
        $technology = Technology::get();
        $edits = Project::find($id);
        
        return view("Project.edit",compact('edits','technology'));
        
    }

    public function adminUpdate(ProjectRequest $request,$id)
    {
        $update = Project::find($id);
        $update->technology_id = implode(",",$request->technology_name);
        $update->project_name = $request->project_name;
        
        $update->update();
        return redirect('Project');
    }

    public function adminDelete($id)
    {
        $delete = Project::find($id)->delete();
        return redirect()->back();
    }

    public function CompletProject()
    {
        $getid = $_GET['id'];

        $update = Project::find($getid);
        $update->complete_project = "Complete";
        $update->update();

        return redirect('Project');
    }
}
