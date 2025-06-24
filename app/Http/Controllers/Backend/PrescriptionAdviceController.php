<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Advice;
use App\Models\Backend\PrescriptionAdvice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PrescriptionAdviceController extends Controller
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
            'advice_id'=> 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_advice = new PrescriptionAdvice();
        $prescription_advice->prescription_id = $request->prescription_id;

        if($request->has('advice_id')){
            $advice = $request->advice_id;
            if(is_numeric($advice)){
                $advice_text = advice::find($advice)->name_eng;
                $advice_id = $advice;
            }else{
                $new_advice = new advice();
                $new_advice->name_eng = $advice;
                $new_advice->save();
                $advice_id = $new_advice->id;
                $advice_text = $advice;
            }
            $prescription_advice->advice_id = $advice_id;
            $prescription_advice->advice_value = $advice_text;
        }
        
        $prescription_advice->save();


        return response()->json($prescription_advice);
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
        $isExisted = PrescriptionAdvice::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
