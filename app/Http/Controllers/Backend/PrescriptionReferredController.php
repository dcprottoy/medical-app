<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Referred;
use App\Models\Backend\PrescriptionReferred;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PrescriptionReferredController extends Controller
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
            'referred_id'=> 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_referred = new PrescriptionReferred();
        $prescription_referred->prescription_id = $request->prescription_id;

        if($request->has('referred_id')){
            $referred = $request->referred_id;
            if($request->new_referred == 0){
                $referred_text = Referred::find($referred)->name_eng;
                $referred_id = $referred;
            }else{
                $new_referred = new Referred();
                $new_referred->name_eng = $referred;
                $new_referred->save();
                $referred_id = $new_referred->id;
                $referred_text = $referred;
            }
            $prescription_referred->referred_id = $referred_id;
            $prescription_referred->referred = $referred_text;
        }
        
        $prescription_referred->save();


        return response()->json($prescription_referred);
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
        $isExisted = PrescriptionReferred::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
