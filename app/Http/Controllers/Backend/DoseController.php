<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Dose;

class DoseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dose'] = Dose::paginate(5);
        return view('backend.dose.index',$data);
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
            $advice = new Dose();
            $advice->fill($request->all())->save();
            return back()->with('success','New Advice Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Dose::findOrFail($id);
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
            $advice = Dose::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'name_bang',
                                    'status']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Advice '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Dose::find($id)){
            $createObject = Dose::find($id);
            $createObject->delete();
            return back()->with('success','Diagnosis Remove Successfully');
        }else{
            return back()->with('danger','Diagnosis Not Found');
        }
    }

    public function search(Request $request){
        $search = $request->q;
        $diagnosis = Dose::where('name_eng','LIKE','%'.$search.'%')->get();
        return $diagnosis;
    }
}
