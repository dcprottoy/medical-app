<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\PrescriptionMedicines;
use App\Models\Backend\Dose;
use App\Models\Backend\DoseDuration;
use App\Models\Backend\DoseFrequency;
use App\Models\Backend\Medicines;
use App\Models\Backend\Usage;
use Illuminate\Support\Carbon;

class PrescriptionMedicineController extends Controller
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
            'medicines_id'=> 'required',
        ]);
        
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_medicines = new PrescriptionMedicines();
        $prescription_medicines->prescription_id = $request->prescription_id;

        if($request->has('medicines_id')){
            $medicines = $request->medicines_id;
            if($request->new_medicines == 0){
                $medicines_text = Medicines::find($medicines)->name;
                $medicines_id = $medicines;
            }else{
                $new_medicines = new Medicines();
                $new_medicines->name = $medicines;
                $new_medicines->save();
                $medicines_id = $new_medicines->id;
                $medicines_text = $medicines;
            }
            $prescription_medicines->medicine_id = $medicines_id;
            $prescription_medicines->medicine = $medicines_text;
        }
        if($request->has('dose_id')){
            $dose = $request->dose_id;
            if($request->new_dose == 0){
                $dose_text = Dose::find($dose)->name_eng;
                $dose_id = $dose;
            }else{
                $new_dose = new Dose();
                $new_dose->name_eng = $dose;
                $new_dose->save();
                $dose_id = $new_dose->id;
                $dose_text = $dose;
            }
            $prescription_medicines->dose_id = $dose_id;
            $prescription_medicines->dose = $dose_text;
        }
        if($request->has('dose_duration_id')){
            $dose_duration = $request->dose_duration_id;
            if($request->new_dose_duration == 0){
                $dose_duration_text = DoseDuration::find($dose_duration)->name_eng;
                $dose_duration_id = $dose_duration;
            }else{
                $new_dose_duration = new DoseDuration();
                $new_dose_duration->name_eng = $dose_duration;
                $new_dose_duration->save();
                $dose_duration_id = $new_dose_duration->id;
                $dose_duration_text = $dose_duration;
            }
            $prescription_medicines->dose_duration_id = $dose_duration_id;
            $prescription_medicines->dose_duration = $dose_duration_text;
        }

        if($request->has('dose_frequency_id')){
            $dose_frequency = $request->dose_frequency_id;
            if($request->new_dose_frequency == 0){
                $dose_frequency_text = DoseFrequency::find($dose_frequency)->name_eng;
                $dose_frequency_id = $dose_frequency;
            }else{
                $new_dose_frequency = new DoseFrequency();
                $new_dose_frequency->name_eng = $dose_frequency;
                $new_dose_frequency->save();
                $dose_frequency_id = $new_dose_frequency->id;
                $dose_frequency_text = $dose_frequency;
            }
            $prescription_medicines->dose_frequency_id = $dose_frequency_id;
            $prescription_medicines->dose_frequency = $dose_frequency_text;
        }

        if($request->has('usage_id')){
            $usage = $request->usage_id;
            if($request->new_usage == 0){
                $usage_text = Usage::find($usage)->name_eng;
                $usage_id = $usage;
            }else{
                $new_usage = new Usage();
                $new_usage->name_eng = $usage;
                $new_usage->save();
                $usage_id = $new_usage->id;
                $usage_text = $usage;
            }
            $prescription_medicines->usage_id = $usage_id;
            $prescription_medicines->usage = $usage_text;
        }
        
        $prescription_medicines->save();


        return response()->json($prescription_medicines);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return PrescriptionMedicines::find($id);
        
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
       $prescription_medicines = PrescriptionMedicines::find($id);

        if($request->has('medicines_id')){
            $medicines = $request->medicines_id;
            if($request->new_medicines == 0){
                $medicines_text = Medicines::find($medicines)->name;
                $medicines_id = $medicines;
            }else{
                $new_medicines = new Medicines();
                $new_medicines->name = $medicines;
                $new_medicines->save();
                $medicines_id = $new_medicines->id;
                $medicines_text = $medicines;
            }
            $prescription_medicines->medicine_id = $medicines_id;
            $prescription_medicines->medicine = $medicines_text;
        }
        if($request->has('dose_id')){
            $dose = $request->dose_id;
            if($request->new_dose == 0){
                $dose_text = Dose::find($dose)->name_eng;
                $dose_id = $dose;
            }else{
                $new_dose = new Dose();
                $new_dose->name_eng = $dose;
                $new_dose->save();
                $dose_id = $new_dose->id;
                $dose_text = $dose;
            }
            $prescription_medicines->dose_id = $dose_id;
            $prescription_medicines->dose = $dose_text;
        }
        if($request->has('dose_duration_id')){
            $dose_duration = $request->dose_duration_id;
            if($request->new_dose_duration == 0){
                $dose_duration_text = DoseDuration::find($dose_duration)->name_eng;
                $dose_duration_id = $dose_duration;
            }else{
                $new_dose_duration = new DoseDuration();
                $new_dose_duration->name_eng = $dose_duration;
                $new_dose_duration->save();
                $dose_duration_id = $new_dose_duration->id;
                $dose_duration_text = $dose_duration;
            }
            $prescription_medicines->dose_duration_id = $dose_duration_id;
            $prescription_medicines->dose_duration = $dose_duration_text;
        }

        if($request->has('dose_frequency_id')){
            $dose_frequency = $request->dose_frequency_id;
            if($request->new_dose_frequency == 0){
                $dose_frequency_text = DoseFrequency::find($dose_frequency)->name_eng;
                $dose_frequency_id = $dose_frequency;
            }else{
                $new_dose_frequency = new DoseFrequency();
                $new_dose_frequency->name_eng = $dose_frequency;
                $new_dose_frequency->save();
                $dose_frequency_id = $new_dose_frequency->id;
                $dose_frequency_text = $dose_frequency;
            }
            $prescription_medicines->dose_frequency_id = $dose_frequency_id;
            $prescription_medicines->dose_frequency = $dose_frequency_text;
        }

        if($request->has('usage_id')){
            $usage = $request->usage_id;
            if($request->new_usage == 0){
                $usage_text = Usage::find($usage)->name_eng;
                $usage_id = $usage;
            }else{
                $new_usage = new Usage();
                $new_usage->name_eng = $usage;
                $new_usage->save();
                $usage_id = $new_usage->id;
                $usage_text = $usage;
            }
            $prescription_medicines->usage_id = $usage_id;
            $prescription_medicines->usage = $usage_text;
        }
        
        $prescription_medicines->save();


        return response()->json($prescription_medicines);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isExisted = PrescriptionMedicines::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
