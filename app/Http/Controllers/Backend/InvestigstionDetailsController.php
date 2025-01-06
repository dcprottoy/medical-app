<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationDetails;
class InvestigstionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Working";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = Validator::make($request->all(),[
            'investigation_main_id' => 'required',
            'details_name' => 'required',
            'serial' => 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_details = new InvestigationDetails();
            $inv_details->fill($request->all())->save();
            return back()->with('success','New Investigation Details Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationDetails::findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['inv_main'] = InvestigationDetails::with('type')->find($id);
        $data['inv_types'] = InvestigationDetails::all();

        return view('backend.investigationmain.show',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'investigation_main_id' => 'required',
            'details_name' => 'required',
            'serial' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_main = InvestigationDetails::find($id);
            $inv_main->fill($request->all())->save();
            return back()->with('success','Investigation Detail Updated Successfully');
        }

    }
    public function search(Request $request)
    {
        $lastid = InvestigationDetails::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $createObject = InvestigationDetails::find($id);
        if($createObject){
            $createObject->delete();
            return back()->with('success','Investigation Details Remove Successfully');
        }else{
            return back()->with('danger','Investigation Details Not Found');
        }
    }
}
