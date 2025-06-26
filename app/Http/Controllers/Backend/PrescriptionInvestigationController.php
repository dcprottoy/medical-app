<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\TestsList;
use App\Models\Backend\PrescriptionInvestigation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PrescriptionInvestigationController extends Controller
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
            'investigations_id'=> 'required',
        ]);
        // return $request->all();
        if($validated->fails()){
            
            return response(['error'=>'Something went wrong !!']);
            // return back()->withErrors($validated)->withInput();
        }

        $prescription_investigations = new PrescriptionInvestigation();
        $prescription_investigations->prescription_id = $request->prescription_id;

        if($request->has('investigations_id')){
            $investigations = $request->investigations_id;
            if(is_numeric($investigations)){
                $investigations_text = TestsList::find($investigations)->name_eng;
                $investigations_id = $investigations;
            }else{
                $new_investigations = new TestsList();
                $new_investigations->name_eng = $investigations;
                $new_investigations->save();
                $investigations_id = $new_investigations->id;
                $investigations_text = $investigations;
            }
            $prescription_investigations->investigations_id = $investigations_id;
            $prescription_investigations->investigations_value = $investigations_text;
        }
        
        $prescription_investigations->save();


        return response()->json($prescription_investigations);
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
        $isExisted = PrescriptionInvestigation::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
