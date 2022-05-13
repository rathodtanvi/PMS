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
        return view('Client.Project.index');
    }

    public function DispProject(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::get();
            
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="checkbox" value="'.$item->id.'" name="chk[]" onclick="checkboxchecked()"/>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = "<div class='actiondiv'> <a href='edit_project/".$row['id']."' class='btn-edit'> Edit </a>&nbsp;<a href='delete_project/".$row['id']."' class='btn-delete'> Delete </a></div>";
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
        return view('Client.Project.add',compact('technology'));
    }
    public function Addproject(Request $request)
    {

        $check = Project::where("Project_Name","=",$request['projectnm'])->pluck('Project_Name')->toArray();
        
        if(in_array($request['projectnm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Project Name Already exist.']);
        }
        else
        {
            $tech = new Project;
            $tech->Project_Name = $request['projectnm'];
            $tech->Technology_Name = implode(' , ', $request->technm);
            $tech->save();

            return redirect('http://localhost:8080/API_PMS/public/Project');
        }
    }

    public function EditProject($id)
    {
        $technology = Technology::get();
        $edits = Project::find($id);
        
        return view("Client.Project.edit",compact('edits','technology'));
        
    }

    public function Update(Request $request,$id)
    {
        $update = Project::find($id);
        $update->Project_Name = $request->input('projectnm');
        $update->Technology_Name = implode(',', $request->technm);
        
        $update->update();
        return redirect('http://localhost:8080/API_PMS/public/Project');
    }

    public function Delete($id)
    {
        $delete = Project::find($id)->delete();
        return redirect()->back();
    }


    /* -------------------------------- */
    /* Admin side Technology Controller */


    public function adminProject()
    {
        return view('Admin.Project.index');
    }

    public function DispAdminProject(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::get();
            
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="checkbox" value="'.$item->id.'" name="chk[]" onclick="checkboxchecked()"/>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = "<div class='actiondiv'> <a href='admin_Editproject/".$row['id']."' class='btn-edit'> Edit </a>&nbsp;<a href='admin_DeleteProject/".$row['id']."' class='btn-delete'> Delete </a></div>";
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
        return view('Admin.Project.add',compact('technology'));
    }
    public function adminAddproject(Request $request)
    {
        $check = Project::where("Project_Name","=",$request['projectnm'])->pluck('Project_Name')->toArray();
        
        if(in_array($request['projectnm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Project Name Already exist.']);
        }
        else
        {
            $tech = new Project;
            $tech->Project_Name = $request['projectnm'];
            $tech->Technology_Name = implode(' , ', $request->technm);
            $tech->save();

            return redirect('http://localhost:8080/API_PMS/public/AdminProject');
        }
    }

    public function adminEditProject($id)
    {
        $technology = Technology::get();
        $edits = Project::find($id);
        
        return view("Admin.Project.edit",compact('edits','technology'));
        
    }

    public function adminUpdate(Request $request,$id)
    {
        $update = Project::find($id);
        $update->Project_Name = $request->input('projectnm');
        $update->Technology_Name = implode(',', $request->technm);
        
        $update->update();
        return redirect('http://localhost:8080/API_PMS/public/AdminProject');
    }

    public function adminDelete($id)
    {
        $delete = Project::find($id)->delete();
        return redirect()->back();
    }

}
