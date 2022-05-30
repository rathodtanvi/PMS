<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technology;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class TechnologyController extends Controller
{
    /*public function AddTech(Request $request)
    {
        $check = Technology::where("technology_name","=",$request['technm'])->pluck('technology_name')->toArray();
        
        if(in_array($request['technm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Technology Already exist.']);
        }
        else
        {
            $tech = new Technology;
            $tech->Technology_Name = $request['technm'];
            $tech->save();

            return redirect('Technology');
        }

    }

    public function index()
    {
        return view('Technology.index');
    }

    public function ShowTech(Request $request)
    {
        if ($request->ajax()) {
            $data = Technology::get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='edit_tech/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function Edit($id)
    {
        $edits = Technology::find($id);
    
        return view("Technology.edit",compact('edits'));
        
    }
    
    public function Update(Request $request,$id)
    {
        $update = Technology::find($id);
        $update->technology_name = $request->input('technm');
        
        $update->update();
        return redirect('Technology');
    }*/


    
    /* -------------------------------- */
    /* Admin side Technology Controller */



    public function Adminindex()
    {
        return view('Technology.index');
    }

    public function AdminShowTech(Request $request)
    {
        if ($request->ajax()) {
            $data = Technology::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='EditTech/".$row['id']."' class='edit btn btn-primary btn-sm m-1'> Edit </a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addTechnology(Request $request)
    {
        $check = Technology::where("technology_name","=",$request['technm'])->pluck('technology_name')->toArray();
        
        if(in_array($request['technm'],$check))
        {
            return redirect()->back()->withErrors(['msg' => 'This Technology Already exist.']);
        }
        else
        {
            $tech = new Technology;
            $tech->technology_name = $request['technm'];
            $tech->save();

            return redirect('Technology');
        }
    }
    public function editTechnology($id)
    {
        $edits = Technology::find($id);
    
        return view("Technology.edit",compact('edits'));
    }

    public function UpdateTechnology(Request $request,$id)
    {
        $update = Technology::find($id);
        $update->technology_name = $request->input('technm');
        
        $update->update();
        return redirect('Technology');
    }
}
