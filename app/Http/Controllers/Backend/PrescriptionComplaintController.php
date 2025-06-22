<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\PrescriptionComplaint;
use App\Models\Backend\Complaint;
use App\Models\Backend\ComplaintValue;
use App\Models\Backend\ComplaintDuration;
use App\Models\Backend\PrescriptionMain;
use Illuminate\Support\Carbon;

class PrescriptionComplaintController extends Controller
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
            'complaint_id'=> 'required',
        ]);
        
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_complaint = new PrescriptionComplaint();
        $prescription_complaint->prescription_id = $request->prescription_id;

        if($request->has('complaint_id')){
            $complaint = $request->complaint_id;
            if(is_numeric($complaint)){
                $complaint_text = Complaint::find($complaint)->name_eng;
                $complaint_id = $complaint;
            }else{
                $new_complaint = new Complaint();
                $new_complaint->name_eng = $complaint;
                $new_complaint->save();
                $complaint_id = $new_complaint->id;
                $complaint_text = $complaint;
            }
            $prescription_complaint->complaint_id = $complaint_id;
            $prescription_complaint->complaint = $complaint_text;
        }
        if($request->has('complaint_value_id')){
            $complaint_value = $request->complaint_value_id;
            if(is_numeric($complaint_value)){
                $complaint_value_text = ComplaintValue::find($complaint_value)->name_eng;
                $complaint_value_id = $complaint_value;
            }else{
                $new_complaint_value = new ComplaintValue();
                $new_complaint_value->name_eng = $complaint_value;
                $new_complaint_value->save();
                $complaint_value_id = $new_complaint_value->id;
                $complaint_value_text = $complaint_value;
            }
            $prescription_complaint->complaint_duration_value_id = $complaint_value_id;
            $prescription_complaint->complaint_duration_value = $complaint_value_text;
        }
        if($request->has('complaint_duration_id')){
            $complaint_duration = $request->complaint_duration_id;
            if(is_numeric($complaint_duration)){
                $complaint_duration_text = ComplaintDuration::find($complaint_duration)->name_eng;
                $complaint_duration_id = $complaint_duration;
            }else{
                $new_complaint_duration = new ComplaintDuration();
                $new_complaint_duration->name_eng = $complaint_duration;
                $new_complaint_duration->save();
                $complaint_duration_id = $new_complaint_duration->id;
                $complaint_duration_text = $complaint_duration;
            }
            $prescription_complaint->complaint_duration_id = $complaint_duration_id;
            $prescription_complaint->complaint_duration = $complaint_duration_text;
        }
        
        $prescription_complaint->save();


        return response()->json($prescription_complaint);
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
        $isExisted = PrescriptionComplaint::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
