<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\AppointmentFees;
use App\Models\Backend\AppointmentType;

use Illuminate\Support\Carbon;

class AppointmentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['appointfees'] = AppointmentFees::paginate(5);
        $data['appointtypes'] = AppointmentType::all();
        return view('backend.appointmentfee.index',$data);
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
            'day_diff' => 'required',
            'appointment_type_id' => 'required',
            'fee_amount' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $advice = new AppointmentFees();
            $advice->fill($request->all())->save();
            return back()->with('success','New Appointment Fee Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = AppointmentFees::findOrFail($id);
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
            'day_diff' => 'required',
            'appointment_type_id' => 'required',
            'fee_amount' => 'required',
        ]);
        // return $request->input();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $advice = AppointmentFees::findOrFail($id);
            if(!$request->has('is_default')) $request->merge(['is_default' => 0]);
            $data = $request->only(['day_diff',
                                    'appointment_type_id',
                                    'fee_amount',
                                    'is_default',
                                    'status']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Appointment Fee '.$advice->name_eng.' Updated Successfully');


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(AppointmentFees::find($id)){
            $createObject = AppointmentFees::find($id);
            @unlink($createObject->Image);
            $createObject->delete();
            return back()->with('success',' Appointment Fee Remove Successfully');
        }else{
            return back()->with('danger',' Appointment Fee Not Found');
        }
    }
}
