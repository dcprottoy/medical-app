<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Diagnosis;
use App\Models\Backend\PrescriptionDiagnosis;
use Illuminate\Support\Carbon;

class PrescriptionDiagnosisController extends Controller
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
        $validated = Validator::make($request->all(),[
            'prescription_id'=> 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return response(['error'=>'Something went wrong !!']);
            // return back()->withErrors($validated)->withInput();
        }
        if($request->has('formData')){
            PrescriptionDiagnosis::where('prescription_id',$request->prescription_id)->delete();
            $responseData = [];
            $diagnosisData = $request->formData;
            // return $diagnosisData;
            foreach ($diagnosisData as $key => $value) {
                $presDiagnosis = new PrescriptionDiagnosis();
                if($value['newItem'] == 'true'){
                    $new_diagnosis = new Diagnosis();
                    $new_diagnosis->name_eng = $value['text'];
                    $new_diagnosis->save();
                    $presDiagnosis->fill([
                        'prescription_id' => $request->prescription_id,
                        'diagnosis_id' => $new_diagnosis->id,
                        'diagnosis_value' => $new_diagnosis->name_eng,
                    ])->save();
                        $responseData[] = $presDiagnosis;
                }else{

                    $presDiagnosis->fill([
                        'prescription_id' => $request->prescription_id,
                        'diagnosis_id' => $value['id'],
                        'diagnosis_value' => $value['text'],
                    ])->save();
                    $responseData[] = $presDiagnosis;

                }

            }

                return response()->json($responseData);

        }
        return response()->json(['error'=>'No Diagnosis Selected !!']);

        


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $diagnosis = PrescriptionDiagnosis::where('prescription_id','=',$id)->get();
        if($diagnosis->isNotEmpty()){
            return response()->json(['diagnosis'=>$diagnosis,"success"=>true]);
        }else{
            return response()->json(['diagnosis'=>$diagnosis,"success"=>false]);
        }
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
        $isExisted = PrescriptionDiagnosis::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
    
}
