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
            'diagnosis_id'=> 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_diagnosis = new PrescriptionDiagnosis();
        $prescription_diagnosis->prescription_id = $request->prescription_id;

        if($request->has('diagnosis_id')){
            $diagnosis = $request->diagnosis_id;
            if(is_numeric($diagnosis)){
                $diagnosis_text = Diagnosis::find($diagnosis)->name_eng;
                $diagnosis_id = $diagnosis;
            }else{
                $new_diagnosis = new Diagnosis();
                $new_diagnosis->name_eng = $diagnosis;
                $new_diagnosis->save();
                $diagnosis_id = $new_diagnosis->id;
                $diagnosis_text = $diagnosis;
            }
            $prescription_diagnosis->diagnosis_id = $diagnosis_id;
            $prescription_diagnosis->diagnosis_value = $diagnosis_text;
        }
        
        $prescription_diagnosis->save();


        return response()->json($prescription_diagnosis);
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
        $isExisted = PrescriptionDiagnosis::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
    
}
