<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationType;

class InvestigationTypeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['inv_types'] = InvestigationType::paginate(5);
        return view('backend.investigationtype.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_type = new InvestigationType();
            $inv_type->fill($request->all())->save();
            return back()->with('success','New Investigation Type Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationType::findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $inv_type = InvestigationType::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'duration',
                                    'status']
                                );
            $inv_type->fill($data)->save();
            return back()->with('success','Investigation Type '.$inv_type->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvestigationType::find($id)){
            $createObject = InvestigationType::find($id);
            $createObject->delete();
            return back()->with('success',' Investigation Type Remove Successfully');
        }else{
            return back()->with('danger',' Investigation Type Not Found');
        }
    }
}
