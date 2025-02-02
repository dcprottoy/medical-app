<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Backend\Patients;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Backend\Appoinments;
use App\Models\Backend\BillMain;
use App\Models\Backend\Doctors;
use Illuminate\Support\Facades\Auth;


class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['patients'] = Patients::orderBy('id','DESC')->get();
        return view('backend.patients.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.patients.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request);
        $date = Carbon::now();
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = Patients::where('patient_id','>',$checkingID)->orderBy('patient_id', 'desc')->first();

        if($lastid){
            $patient_id = $lastid->patient_id+1;
        }else{
            $patient_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        // return $patient_id;
        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'contact_no' => 'required'
        ]);
        $birthDate = $date->subYears($request->year)->subMonths($request->month)->subDays($request->day)->toDateString();
        // return $birthDate;
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $patient = new Patients();
            $patient->fill($request->all());
            $patient->patient_id = (int)$patient_id;
            if(!$request->filled('birth_date')){
                $patient->birth_date = $birthDate;
            }
            try{
                $patient->save();
            }catch(\Exception $e) {
                return response()->json(["error"=>'Patient Created Failed',"message"=>$e->getMessage()]);
              }
            if ($request->has('save_type')) {
                if($request->save_type == 2){
                    $date = Carbon::now();
                    $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
                    $lastid = Appoinments::where('appoint_id','>',$checkingID)->orderBy('appoint_id', 'desc')->first();

                    if($lastid){
                        $appoint_id = $lastid->appoint_id+1;
                    }else{
                        $appoint_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
                    }
                    $patient_id = $patient->patient_id;
                    $doctor_id = Auth::user()->user_id;
                    $serial_no = 1;
                    $serial = Appoinments::where('doctor_id',$doctor_id)->where('appointed_date',$date->format('Y-m-d'))->orderBy('serial','DESC')->first();
                    if($serial){
                        $serial_no = $serial->serial+1;
                    }
                    $appointed = new Appoinments();
                    $appointed->appoint_id = (int)$appoint_id;
                    $appointed->patient_id = (int)$patient_id;
                    $appointed->doctor_id = (int)$doctor_id;
                    $appointed->appointed_date = $date->format('Y-m-d');
                    $appointed->serial = $serial_no;
                    $appointed->appointment_type_id = $request->appointment_type_id;
                    $appointed->save();
                    return response()->json([
                        "success"=>$appointed,
                        "patient"=>$patient
                    ]);

                    // return response()->json(["success"=>$date->format('Y-m-d')]);
                }elseif($request->save_type == 3){
                    // if(){

                    // }
                    return response()->json($patient);



                    // return response()->json(["success"=>$date->format('Y-m-d')]);
                }
            }else{
                return back()->with('success','New Patient Created Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lastid = Patients::findOrFail($id);
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
            'address' => 'required',
            'contact_no' => 'required'
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $date = Carbon::now();
            $patient = Patients::findOrFail($id);
            $data = $request->only(['name',
                                    'patient_id',
                                    'address',
                                    'contact_no',
                                    'emr_cont_no',
                                    'birth_date',
                                    'sex']
                                );
            if($patient->birth_date == $data['birth_date']){
                $data['birth_date'] = $date->subYears($request->year)->subMonths($request->month)->subDays($request->day)->toDateString();
            }

            $patient->fill($data)->save();
            return back()->with('success','Patient Information Created Successfully');
        }
    }


    public function search(Request $request)
    {
        $lastid = Patients::where('patient_id', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Patients::find($id)){
            $createObject = Patients::find($id);
            $createObject->delete();
            return back()->with('success','Brand Image Remove Successfully');
        }else{
            return back()->with('danger','Brand Image Not Found');
        }
    }

}
