<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationEquipSetup;

class InvestigationEquiSetController extends Controller
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
                'investigation_equip_id' => 'required',
                'quantity' => 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_eqp = new InvestigationEquipSetup();
            $inv_eqp->fill($request->all())->save();
            return back()->with('success','New Investigation Equipment Setup Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationEquipSetup::findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['inv_main'] = InvestigationEquipSetup::with('type')->find($id);
        $data['inv_types'] = InvestigationEquipSetup::all();

        return view('backend.investigationmain.show',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
                'investigation_main_id' => 'required',
                'investigation_equip_id' => 'required',
                'quantity' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_eqp = InvestigationEquipSetup::find($id);
            $inv_eqp->fill($request->all())->save();
            return back()->with('success','Investigation Detail Updated Successfully');
        }

    }
    public function search(Request $request)
    {
        $lastid = InvestigationEquipSetup::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $createObject = InvestigationEquipSetup::find($id);
        if($createObject){
            $createObject->delete();
            return back()->with('success','Investigation Equipment Setup Remove Successfully');
        }else{
            return back()->with('danger','Investigation Equipment Setup Not Found');
        }
    }
}
