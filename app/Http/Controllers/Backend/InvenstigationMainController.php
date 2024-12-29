<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\InvestigationMain;
use App\Models\Backend\InvestigationType;


class InvenstigationMainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['inv_types'] = InvestigationType::all();
        $data['inv_main'] = InvestigationMain::paginate(5);

        return view('backend.investigationmain.index',$data);
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
            'investigation_name' => 'required',
            'investigation_type_id' => 'required',
            'price' => 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_main = new InvestigationMain();
            $inv_main->fill($request->all())->save();
            return back()->with('success','New Investigation Registered Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Doctors::with('department')->findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['doctor'] = InvestigationMain::find($id);
        return view('backend.doctors.edit',$data);
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
            $inv_main = InvestigationMain::find($id);
            $inv_main->fill($request->all())->save();
            return back()->with('success','Investigation Information Updated Successfully');
        }

    }
    public function search(Request $request)
    {
        $lastid = InvestigationMain::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvestigationMain::find($id)){
            $createObject = InvestigationMain::find($id);
            $createObject->delete();
            return back()->with('success','Investigation Remove Successfully');
        }else{
            return back()->with('danger','Investigation Not Found');
        }
    }
}
