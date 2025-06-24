<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\PrescriptionOnExamination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PrescriptionOnExaminationController extends Controller
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

        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }
        $existed = PrescriptionOnExamination::where('prescription_id',$request->prescription_id)->first();
        if($existed){
            $existed->fill($request->all());
            $existed->save();
            return response()->json(['success'=>'New Prescription On Examination Created Successfully','on_exam'=>$existed]);
        }else{
            $on_exam = new PrescriptionOnExamination();
            $on_exam->fill($request->all());
            $on_exam->save();
            return response()->json(['success'=>'New Prescription On Examination Created Successfully','on_exam'=>$on_exam]);
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
