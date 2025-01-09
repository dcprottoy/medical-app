<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Diagnosis;
use Illuminate\Support\Carbon;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['symptomps'] = Diagnosis::paginate(5);
        return view('backend.diagnosis.index',$data);
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
            $advice = new Diagnosis();
            $advice->fill($request->all())->save();
            return back()->with('success','New Diagnosis Created Successfully');

            // $lists = ["Hypertension","Diabetes Mellitus","Anemia","Hypothyroidism","Hyperlipidemia","Myocardial Infarction","Congestive Heart Failure","Atrial Fibrillation","Coronary Artery Disease","Cardiomyopathy","Asthma","Chronic Obstructive Pulmonary Disease (COPD)","Pneumonia","Pulmonary Embolism","Tuberculosis","Stroke (Cerebrovascular Accident)","Epilepsy","Parkinson's Disease","Multiple Sclerosis","Migraine","Gastroesophageal Reflux Disease (GERD)","Irritable Bowel Syndrome (IBS)","Crohn’s Disease","Ulcerative Colitis","Hepatitis","Major Depressive Disorder","Generalized Anxiety Disorder","Schizophrenia","Bipolar Disorder","Post-Traumatic Stress Disorder (PTSD)","Osteoarthritis","Rheumatoid Arthritis","Fractures","Scoliosis","Osteoporosis","Cushing's Syndrome","Addison's Disease","Hyperthyroidism","Type 1 Diabetes","Polycystic Ovary Syndrome (PCOS)","Psoriasis","Eczema (Atopic Dermatitis)","Acne Vulgaris","Vitiligo","Melanoma","Breast Cancer","Lung Cancer","Leukemia","Lymphoma","Prostate Cancer"];
            // foreach( $lists as $item){
            // $advice = new Diagnosis();
            // $advice->name_eng = $item;
            // $advice->status = 1;
            // $advice->save();
            // }
            // return back()->with('success','New Diagnosis Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Diagnosis::findOrFail($id);
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
            $advice = Diagnosis::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'name_bang',
                                    'status']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Diagnosis '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Diagnosis::find($id)){
            $createObject = Diagnosis::find($id);
            $createObject->delete();
            return back()->with('success','Diagnosis Remove Successfully');
        }else{
            return back()->with('danger','Diagnosis Not Found');
        }
    }
}
