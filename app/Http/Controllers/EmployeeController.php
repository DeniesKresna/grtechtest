<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Notification;
use App\Notifications\EmployeeCreations;
use App\Http\Requests\EmployeeRequest;
use App\Traits\Helper;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    use Helper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $from = $request->input('from','');
            $to = $request->input('to','');
            $data = Employee::columnFilter();
            if($from != '' && $to != ''){
                $data = $data->dateCreationFilter($request->from, $request->to);
            }
            return $this->dataTable($data->get(),true,[],['full_name','company_name']);
        }

        $companies = Company::all();
        
        return view('contents.employee.index',['pageTitle'=>'Employee','rootMenu'=>'Page','subMenu'=>'Employee', 'companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        //
        $validated = $request->validated();

        $data = Employee::create($request->all());
        if($data){
            if($data->company_id)
                Notification::route('mail', $data->company->email)->notify(new EmployeeCreations($data->firstname, $data->lastname));
        }

        return response()->json("ok",200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Employee::find($id);
            if($data){
                return response()->json($data);
            }else{
                return response()->json("Employee not found", 401);
            }
        }

        $companies = Company::all();
        
        return view('contents.employee.index',['pageTitle'=>'Employee','rootMenu'=>'Page','subMenu'=>'Employee', 'companies'=>$companies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        //
        $validated = $request->validated();

        $data = Employee::find($id);
        if(!$data){
            return response()->json("data not found",401);
        }
        if(!$data->update($request->all())){
            return response()->json("update failed",500);
        }

        return response()->json("ok",200);
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
        $data = Employee::find($id);
        if(!$data){
            return response()->json("data not found",401);
        }
        if($data->delete())
            return response()->json("ok",200);
        else
            return response()->json("delete failed",500);
    }
}
