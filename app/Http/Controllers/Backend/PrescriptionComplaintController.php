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
        ]);
        
        if($validated->fails()){
            return response()->json(['error'=>'Something went wrong !!']);
            // return back()->withErrors($validated)->withInput();
        }
        return response()->json($request->all());
        $prescription_complaint = new PrescriptionComplaint();
        $prescription_complaint->prescription_id = $request->prescription_id;

        if($request->has('complaint_id')){
            $complaint = $request->new_complaint;
            if((boolean)$complaint){
                $new_complaint = new Complaint();
                $new_complaint->name_eng = $request->complaint_id;
                $new_complaint->save();
                $complaint_id = $new_complaint->id;
                $complaint_text = $new_complaint->name_eng;
            }else{
                $complaint_text = Complaint::find($request->complaint_id)->name_eng;
                $complaint_id = $request->complaint_id;
            }
            $prescription_complaint->complaint_id = $complaint_id;
            $prescription_complaint->complaint = $complaint_text;
        }
        $prescription_complaint->save();


        return response()->json($prescription_complaint);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $complain = PrescriptionComplaint::where('prescription_id','=',$id)->get();
        if($complain->isNotEmpty()){
            return response()->json(['complain'=>$complain,"success"=>true]);
        }else{
            return response()->json(['complain'=>$complain,"success"=>false]);
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
        $isExisted = PrescriptionComplaint::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
