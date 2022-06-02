<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

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
                    if($row->status == 1)
                    {
                        $actionBtn = "<a href='Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> <i class='bi bi-check-circle'></i> </div>";
                    }
                    else
                    {
                        $actionBtn = "<a href='Editproject/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>&nbsp;<a href='DeleteProject/".$row['id']."' class=' btn btn-danger btn-sm inactive'> Delete </a> <div class='actiondiv'> </div>";
                    }
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

                ->addColumn('teamleader',function(Project $emp){
                    if($emp->user_id == 0)
                    {
                        return '';
                    }
                    else
                    {
                        return $emp->user->name;
                    }
                })
                ->rawColumns(['action'])
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function adminInsertProject()
    {
        $technology = Technology::get();
        $tls=User::where('roles_id','2')->get();
        return view('Project.add',compact('technology','tls'));
    }
    public function adminAddproject(ProjectRequest $request)
    {
        
            $tech = new Project;
            $tech->technology_id= implode(' , ', $request->technology_name);
            $tech->project_name = $request->project_name;
            $tech->user_id=$request->tl_name;
            
            $tech->save();

            return redirect('Project');
    
    }

    public function adminEditProject($id)
    {
        $tls=User::where('roles_id','2')->get();
        $technology = Technology::get();
        $edits = Project::find($id);
        return view("Project.edit",compact('edits','technology','tls'));   
    }

    public function adminUpdate(ProjectRequest $request,$id)
    {
        $update = Project::find($id);
        $update->technology_id = implode(",",$request->technology_name);
        $update->project_name = $request->project_name;
        $update->user_id=$request->tl_name;

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
        $update->status = 1;
        $update->update();

        return redirect('Project');
    }
}
