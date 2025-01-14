<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationGroup;
class InvestigationGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['inv_groups'] = InvestigationGroup::paginate(5);
        return view('backend.investigationgroup.index',$data);
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
            $inv_type = new InvestigationGroup();
            $inv_type->fill($request->all())->save();
            return back()->with('success','New Investigation Group Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationGroup::findOrFail($id);
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
            $inv_group = InvestigationGroup::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'room_no',
                                    'status']
                                );
            $inv_group->fill($data)->save();
            return back()->with('success','Investigation Group '.$inv_group->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvestigationGroup::find($id)){
            $createObject = InvestigationGroup::find($id);
            $createObject->delete();
            return back()->with('success',' Investigation Group Remove Successfully');
        }else{
            return back()->with('danger',' Investigation Group Not Found');
        }
    }
}
