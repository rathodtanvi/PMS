<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technology;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\TechnologyRequest;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class TechnologyController extends Controller
{
    public function index()
    {
        return view('Technology.index');
    }
    public function create()
    {
        return view('Technology.add');
    }
    public function store(TechnologyRequest $request)
    {
        $tech = new Technology;
        $tech->technology_name = $request->technology_name;
        $tech->save();
        return redirect('Technology')->with('status', 'Successfully  Inserted Technology!');     
    }
    public function edit($id)
    {
        $edits = Technology::find($id);
        return view("Technology.edit",compact('edits'));
    }

    public function update(TechnologyRequest $request,$id)
    {
        $update = Technology::find($id);
        $update->technology_name = $request->technology_name;
        $update->update();
        return redirect('Technology')->with('status', 'Successfully  Update Technology!');
    }
    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = Technology::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('Technology.edit',$row->id).'" class="edit btn btn-primary btn-sm m-1"> Edit </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
   
    
    
}
