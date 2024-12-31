<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationSection;

class InvestigationSectionControllers extends Controller
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
            'section_name' => 'required',
            'serial' => 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_section = new InvestigationSection();
            $inv_section->fill($request->all())->save();
            return back()->with('success','New Investigation Registered Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationSection::with('department')->findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['inv_main'] = InvestigationSection::with('type')->find($id);
        $data['inv_types'] = InvestigationSection::all();

        return view('backend.investigationmain.show',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'investigation_name' => 'required',
            'investigation_type_id' => 'required',
            'price' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_main = InvestigationSection::find($id);
            $inv_main->fill($request->all())->save();
            return back()->with('success','Investigation Information Updated Successfully');
        }

    }
    public function search(Request $request)
    {
        $lastid = InvestigationSection::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvestigationSection::find($id)){
            $createObject = InvestigationSection::find($id);
            $createObject->delete();
            return back()->with('success','Investigation Remove Successfully');
        }else{
            return back()->with('danger','Investigation Not Found');
        }
    }
}
