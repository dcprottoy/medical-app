<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Patients;
use App\Models\Backend\Appoinments;

use App\Models\Backend\PrescriptionMain;
use Illuminate\Support\Carbon;

class PrescribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        // return $request->all();

        $date = Carbon::now();
        $checkingID = (int)strval($date->year).'000000';
        $lastid = PrescriptionMain::where('prescription_id','>',$checkingID)->orderBy('prescription_id', 'desc')->first();

        if($lastid){
            $prescription_id = $lastid->prescription_id+1;
        }else{
            $prescription_id = strval($date->year).'000001';
        }
        // return $patient_id;
        $validated = Validator::make($request->all(),[

            'patient_id'=> 'required',
            'doctor_id'=> 'required',
            'prescribed_date'=> 'required',
            'patient_name'=> 'required',
            'patient_gender'=> 'required',
            'patient_age'=> 'required',
        ]);
        
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            $patient_id = $request->patient_id;
            $doctor_id = $request->doctor_id;
            $date = $request->appointed_date;
           
            
            $appointment =  Appoinments::where('appoint_id',$request->appoint_id)->first();
            $appointment->visited = 1;
            $appointment->save();

            if($request->visite_btn == false){
                $prescription = new PrescriptionMain();
                $prescription->prescription_id = (int)$prescription_id;
                $prescription->fill($request->all())->save();
                 return response()->json([
                "success"=>$prescription
                    ]);
           }

            return response()->json([
                "success"=>true
            ]);
           

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
