<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Medicines;
use Illuminate\Support\Carbon;

class MedicinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['advices'] = Medicines::paginate(100);
        return view('backend.medicines.index',$data);
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
            'name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $advice = new Medicines();
            $advice->fill($request->all())->save();
            return back()->with('success','New Medicines Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Medicines::findOrFail($id);
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
            'name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $advice = Medicines::findOrFail($id);
            $data = $request->only(['name',
                                    'generic',
                                    'type']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Advice '.$advice->name.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Medicines::find($id)){
            $createObject = Medicines::find($id);
            $createObject->delete();
            return back()->with('success','Medicine Remove Successfully');
        }else{
            return back()->with('danger','Medicine Not Found');
        }
    }

    public function search(Request $request){
        $search = $request->q;
        $diagnosis = Medicines::where('name','LIKE','%'.$search.'%')->get();
        return $diagnosis;
    }
}
