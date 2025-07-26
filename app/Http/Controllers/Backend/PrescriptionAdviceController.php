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
        ]);
        // return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }

        if($request->has('formData')){
            PrescriptionAdvice::where('prescription_id',$request->prescription_id)->delete();
            $responseData = [];
            $adviceData = $request->formData;
            // return $diagnosisData;
            foreach ($adviceData as $key => $value) {
                $presAdvice = new PrescriptionAdvice();
                if($value['newItem'] == 'true'){
                    $new_advice = new advice();
                    $new_advice->name_eng = $value['text'];
                    $new_advice->save();
                    $presAdvice->fill([
                        'prescription_id' => $request->prescription_id,
                        'advice_id' => $new_advice->id,
                        'advice_value' => $new_advice->name_eng,
                    ])->save();
                        $responseData[] = $presAdvice;
                }else{

                    $presAdvice->fill([
                        'prescription_id' => $request->prescription_id,
                        'advice_id' => $value['id'],
                        'advice_value' => $value['text'],
                    ])->save();
                    $responseData[] = $presAdvice;

                }

            }
            return response()->json($responseData);
        }
        return response()->json(['error'=>'No Advice Selected !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advices = PrescriptionAdvice::where('prescription_id','=',$id)->get();
        if($advices->isNotEmpty()){
            return response()->json(['advices'=>$advices,"success"=>true]);
        }else{
            return response()->json(['advices'=>$advices,"success"=>false]);
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
        $isExisted = PrescriptionAdvice::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
}
