<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\InvestigationEquipment;
use Illuminate\Support\Carbon;

class InvestigationEquipmentControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['inv_equip'] = InvestigationEquipment::paginate(5);
        return view('backend.investigationequipment.index',$data);
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
            'equipment_name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $inv_equip = new InvestigationEquipment();
            $inv_equip->fill($request->all())->save();
            return back()->with('success','New Investigation Equipment Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = InvestigationEquipment::findOrFail($id);
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
            'equipment_name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $inv_equip = InvestigationEquipment::findOrFail($id);
            $data = $request->only(['equipment_name',
                                    'price',
                                    'discount_per',
                                    'discount_amount',
                                    'status',
                                    'final_price']
                                );
            $inv_equip->fill($data)->save();
            return back()->with('success','Advice '.$inv_equip->equipment_name.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvestigationEquipment::find($id)){
            $createObject = InvestigationEquipment::find($id);
            $createObject->delete();
            return back()->with('success','Investigation Equipment Remove Successfully');
        }else{
            return back()->with('danger','Investigation Equipment Not Found');
        }
    }

}
