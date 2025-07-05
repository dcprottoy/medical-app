<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Patients;
use App\Models\Backend\Appoinments;

use App\Models\Backend\PrescriptionMain;
use App\Models\Backend\PrescriptionOnExamination;
use App\Models\Backend\PrescriptionInvestigation;
use App\Models\Backend\PrescriptionComplaint;
use App\Models\Backend\PrescriptionDiagnosis;
use App\Models\Backend\PrescriptionMedicines;
use App\Models\Backend\PrescriptionReferred;
use App\Models\Backend\PrescriptionAdvice;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use Exception;
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
            $check = PrescriptionMain::where('appoint_id',$request->appoint_id)->exists();
            if($check){
                return response()->json(["error"=>"Already Exists"]);
            }
            $patient_id = $request->patient_id;
            $doctor_id = $request->doctor_id;
            $date = $request->appointed_date;
           
            
            $appointment =  Appoinments::where('appoint_id',$request->appoint_id)->first();
            $appointment->visited = $request->visited_btn;
            $appointment->save();

            if($request->visited_btn == 2){
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

    public function search(Request $request)
    {
        if($request->search == null || $request->search == ''){
            $lastid = PrescriptionMain::orderBy('id', 'desc')->limit(20)->get();
            return $lastid;
        }else{
            $lastid = PrescriptionMain::where('prescription_id', 'like', '%'.$request->search.'%')->limit(20)->get();
            return $lastid;
        }
    }

    public function prescriptionDetails(Request $request)
    {

        $appoinmentInfo = Appoinments::with('patient')->where('appoint_id','=',$request->search)->first();

        if($appoinmentInfo->visited == 2){
            $id = $appoinmentInfo->appoint_id;
            $main = PrescriptionMain::where('appoint_id','=',$id)->first();
            $prescription_id = $main->prescription_id;
            $investigations = PrescriptionInvestigation::where('prescription_id','=',$prescription_id)->get();
            $onexam = PrescriptionOnExamination::where('prescription_id','=',$prescription_id)->first();
            $complain = PrescriptionComplaint::where('prescription_id','=',$prescription_id)->get();
            $diagnosis = PrescriptionDiagnosis::where('prescription_id','=',$prescription_id)->get();
            $medicins = PrescriptionMedicines::where('prescription_id','=',$prescription_id)->get();
            $advices = PrescriptionAdvice::where('prescription_id','=',$prescription_id)->get();
            $referred = PrescriptionReferred::where('prescription_id','=',$prescription_id)->get();

            return response()->json(["appointment"=>$appoinmentInfo,"main"=>$main,'investigations'=>$investigations,'onexam'=>$onexam,'complain'=>$complain,'diagnosis'=>$diagnosis,'medicins'=>$medicins,'advices'=>$advices,'referred'=>$referred]);
        }

            return response()->json(["appointment"=>$appoinmentInfo]);
        
    }

    public function importPrescription(Request $request){

            $from_id = $request->fromPrescription_no;
            $to_id = $request->toPrescription_no;

            $investigations = PrescriptionInvestigation::where('prescription_id','=',$from_id)->get();
            $onexam = PrescriptionOnExamination::where('prescription_id','=',$from_id)->first();
            $complain = PrescriptionComplaint::where('prescription_id','=',$from_id)->get();
            $diagnosis = PrescriptionDiagnosis::where('prescription_id','=',$from_id)->get();
            $medicins = PrescriptionMedicines::where('prescription_id','=',$from_id)->get();
            $advices = PrescriptionAdvice::where('prescription_id','=',$from_id)->get();
            $referred = PrescriptionReferred::where('prescription_id','=',$from_id)->get();



            try {

            DB::beginTransaction();

            $new_investigations = [];
            if($investigations->isNotEmpty()){
                foreach($investigations as $investigation){
                    $new_investigations[] = [
                        'prescription_id'=>$to_id,
                        'investigations_id'=>$investigation->investigations_id,
                        'investigations_value'=>$investigation->investigations_value
                    ];
                }

                // return $new_investigations;
                PrescriptionInvestigation::insert($new_investigations);
            }

            $new_onexam = [];
            if($onexam){
                $new_onexam = [
                    'prescription_id'=>$to_id,
                    'pressure'=>$onexam->pressure,
                    'temperature'=>$onexam->temperature,
                    'height'=>$onexam->height,
                    'weight'=>$onexam->weight,
                    'bmi'=>$onexam->bmi,
                ];
                $onexamina = new PrescriptionOnExamination();
                $onexamina->fill($new_onexam);
                $onexamina->save();
            }



            $new_complain = [];
            if($complain->isNotEmpty()){
                foreach($complain as $complains){
                    $new_complain[] = [
                        'prescription_id'=>$to_id,
                        'complaint_id'=>$complains->complaint_id,
                        'complaint'=>$complains->complaint,
                        'complaint_duration'=>$complains->complaint_duration,
                        'complaint_duration_id'=>$complains->complaint_duration_id,
                    ];
                }

                PrescriptionComplaint::insert($new_complain);
            }


            $new_diagnosis = [];
            if($diagnosis->isNotEmpty()){
                foreach($diagnosis as $diagnoses){
                    $new_diagnosis[] = [
                        'prescription_id'=>$to_id,
                        'diagnosis_id'=>$diagnoses->diagnosis_id,
                        'diagnosis_value'=>$diagnoses->diagnosis_value,
                    ];
                }

                PrescriptionDiagnosis::insert($new_diagnosis);
            }


            $new_medicins = [];
            if($medicins->isNotEmpty()){
                foreach($medicins as $medicin){
                    $new_medicins[] = [
                        'prescription_id'=>$to_id,
                        'medicine_id'=>$medicin->medicine_id,
                        'medicine'=>$medicin->medicine,
                        'dose_id'=>$medicin->dose_id,
                        'dose'=>$medicin->dose,
                        'dose_frequency_id'=>$medicin->dose_frequency_id,
                        'dose_frequency'=>$medicin->dose_frequency,
                        'dose_duration_id'=>$medicin->dose_duration_id,
                        'dose_duration'=>$medicin->dose_duration,
                        'usage_id'=>$medicin->usage_id,
                        'usage'=>$medicin->usage,
                    ];
                }

                PrescriptionMedicines::insert($new_medicins);
            }


            $new_advices = [];
            if($advices->isNotEmpty()){
                foreach($advices as $advice){
                    $new_advices[] = [
                        'prescription_id'=>$to_id,
                        'advice_id'=>$advice->advice_id,
                        'advice_value'=>$advice->advice_value,
                    ];
                }

                PrescriptionAdvice::insert($new_advices);
            }


            $new_referred = [];
            if($referred->isNotEmpty()){
                foreach($referred as $referreds){
                    $new_referred[] = [
                        'prescription_id'=>$to_id,
                        'referred_id'=>$referreds->referred_id,
                        'referred'=>$referreds->referred,
                    ];
                }

                PrescriptionReferred::insert($new_referred);
            }
            
            DB::commit(); 

            return response()->json(['success'=>"Successfully Imported"]);
            
            } catch (Exception $e) {
                DB::rollBack(); 

                return response()->json(['error' => 'Transaction failed.', 'message' => $e->getMessage()], 500);
        }

            
    }

}
