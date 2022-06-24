<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Http\Requests\HolidayRequest;
use Yajra\DataTables\DataTables;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Holiday.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Holiday.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayRequest $request)
    {
        $holiday=new Holiday();
        $holiday->name=$request->name;
        $holiday->start_date=$request->start_date;
        $holiday->end_date=$request->end_date;
        $holiday->save();
        return redirect('Holiday')->with('status', 'Successfully Inserted Holiday');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Holiday::find($id);
        return view('Holiday.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolidayRequest $request, $id)
    {
        $data=Holiday::find($id);
        $data->name=$request->name;
        $data->start_date=$request->start_date;
        $data->end_date=$request->end_date;
        $data->update();
        return redirect('Holiday')->with('status', 'Successfully Updated Holiday');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getdata(Request $request)
    {
      if ($request->ajax()) {
          $data=Holiday::all();
          return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn ='<a href="'.route('Holiday.edit',$row->id).'" class="fa fa-edit edit btn btn-primary btn-sm m-1"></a>';
                        $btn = $btn.'<a href="'.route('delete_holiday',$row->id).'" class="fa fa-trash  btn btn-danger btn-sm m-1"></a>';
                        return $btn;
                })
                //Carbon::now()->format('Y-m-d');
                ->rawColumns(['action'])
                ->make(true);
      }
      
    } 
    
    public function delete($id)
    {
        $delete= Holiday::find($id);
        $delete->delete();
        return redirect('Holiday')->with('status', 'Successfully Delete Holiday');
    }
}
