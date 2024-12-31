<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Patients;
use App\Models\Backend\Appoinments;
use App\Models\Backend\AppointmentType;
use Illuminate\Support\Carbon;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['doctors'] = Doctors::with('department')->get();
        // return $data;
        $data['patients'] = Patients::orderBy('id','DESC')->limit(100)->get();
        $data['appointmenttypes'] = AppointmentType::where('status',TRUE)->get();

        return view('backend.appoinments.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.appoinments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $date = Carbon::now();
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = Appoinments::where('appoint_id','>',$checkingID)->orderBy('appoint_id', 'desc')->first();

        if($lastid){
            $appoint_id = $lastid->appoint_id+1;
        }else{
            $appoint_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        // return $patient_id;
        $validated = Validator::make($request->all(),[

            'patient_id'=> 'required',
            'doctor_id'=> 'required',
            'appointed_date'=> 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            $patient_id = $request->patient_id;
            $doctor_id = $request->doctor_id;
            $date = $request->appointed_date;
            $serial_no = 1;
            $serial = Appoinments::where('doctor_id',$doctor_id)->where('appointed_date',$date)->orderBy('serial','DESC')->first();
            if($serial){
                $serial_no = $serial->serial+1;
            }
            $appointed = new Appoinments();
            $appointed->appoint_id = (int)$appoint_id;
            $appointed->serial = $serial_no;
            $appointed->fill($request->all())->save();
            return response()->json([
                "success"=>$appointed
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

        $data['doctor'] = Doctors::find($id);
        return view('backend.doctors.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'degree' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $doctor = Doctors::find($id);
            $doctor->fill($request->all())->save();
            return back()->with('success','Doctor Information Updated Successfully');

        }
    }
    public function getSerial(Request $request){
        $patient_id = $request->patient_id;
        $doctor_id = $request->doctor_id;
        $date = $request->appointed_date;
        $serial = Appoinments::where('patient_id',$patient_id)->where('doctor_id',$doctor_id)->where('appointed_date',$date)->first();
        if($serial){
            return response()->json([
                "message"=>"Already Appointed",
                "data"=>$serial
            ]);
        }else{
            $serial_no = 1;
            $serial = Appoinments::where('doctor_id',$doctor_id)->where('appointed_date',$date)->orderBy('serial','DESC')->first();
            if($serial){
                $serial_no = $serial->serial+1;
            }
            return response()->json([
                "message"=>"New Serial No",
                "data"=>$serial_no
            ]);
        }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Appoinments::find($id)){
            $createObject = Appoinments::find($id);
            @unlink($createObject->Image);
            $createObject->delete();
            return back()->with('success','Brand Image Remove Successfully');
        }else{
            return back()->with('danger','Brand Image Not Found');
        }
    }
}
