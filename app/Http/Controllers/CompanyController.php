<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CompanyRequest;
use App\Traits\Helper;
use App\Models\Company;

class CompanyController extends Controller
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
            return $this->dataTable(Company::all(),['columnName'=>'renderedLogo', 'photoField'=>'logo']);
        }
        
        return view('contents.company.index',['pageTitle'=>'Company','rootMenu'=>'Page','subMenu'=>'Company']);
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
    public function store(CompanyRequest $request)
    {
        //
        $validated = $request->validated();

        $data = Company::create($request->except('logo'));

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = strtotime(date("Y-m-d H:i:s"))."-".$data->id.'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("company",$file, $name);
            $data->logo = $name;
            $data->save();
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
            $data = Company::find($id);
            if($data){
                return response()->json($data);
            }else{
                return response()->json("Company not found", 401);
            }
        }
        
        return view('contents.company.index',['pageTitle'=>'Company','rootMenu'=>'Page','subMenu'=>'Company']);
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
    public function update(CompanyRequest $request, $id)
    {
        //
        $validated = $request->validated();

        $data = Company::find($id);
        if(!$data){
            return response()->json("data not found",401);
        }
        if(!$data->update($request->except('logo'))){
            return response()->json("update failed",500);
        }

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = strtotime(date("Y-m-d H:i:s"))."-".$data->id.'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("company",$file, $name);
            $data->logo = $name;
            $data->save();
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
        $data = Company::find($id);
        if(!$data){
            return response()->json("data not found",401);
        }
        if($data->delete())
            return response()->json("ok",200);
        else
            return response()->json("delete failed",500);
    }
}
