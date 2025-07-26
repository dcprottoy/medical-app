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
        ]);
        // return $request->all();
        if($validated->fails()){
            
            return response(['error'=>'Something went wrong !!']);
            // return back()->withErrors($validated)->withInput();
        }
        if($request->has('formData')){
            PrescriptionInvestigation::where('prescription_id',$request->prescription_id)->delete();
            $responseData = [];
            $investigationsData = $request->formData;
            // return $diagnosisData;
            foreach ($investigationsData as $key => $value) {
                $presInvestigation = new PrescriptionInvestigation();
                if($value['newItem'] == 'true'){
                    $new_investigation = new TestsList();
                    $new_investigation->name_eng = $value['text'];
                    $new_investigation->save();
                    $presInvestigation->fill([
                        'prescription_id' => $request->prescription_id,
                        'investigations_id' => $new_investigation->id,
                        'investigations_value' => $new_investigation->name_eng,
                    ])->save();
                        $responseData[] = $presInvestigation;
                }else{

                    $presInvestigation->fill([
                        'prescription_id' => $request->prescription_id,
                        'investigations_id' => $value['id'],
                        'investigations_value' => $value['text'],
                    ])->save();
                    $responseData[] = $presInvestigation;

                }

            }
            return response()->json($responseData);
        }
        return response()->json(['error'=>'No Investigation Selected !!']);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $investigations = PrescriptionInvestigation::where('prescription_id','=',$id)->get();
        if($investigations->isNotEmpty()){
            return response()->json(['investigations'=>$investigations,"success"=>true]);
        }else{
            return response()->json(['investigations'=>$investigations,"success"=>false]);
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
        $isExisted = PrescriptionInvestigation::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
