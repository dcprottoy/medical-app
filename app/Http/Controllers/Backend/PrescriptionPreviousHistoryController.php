<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\PrevHistory;
use App\Models\Backend\PrescriptionPrevHistory;
use Illuminate\Support\Carbon;

class PrescriptionPreviousHistoryController extends Controller
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
            PrescriptionPrevHistory::where('prescription_id',$request->prescription_id)->delete();
            $responseData = [];
            $historyData = $request->formData;
            // return $historyData;
            foreach ($historyData as $key => $value) {
                $presHistory = new PrescriptionPrevHistory();
                if($value['newItem'] == 'true'){
                    $new_history = new PrevHistory();
                    $new_history->name_eng = $value['text'];
                    $new_history->save();
                    $presHistory->fill([
                        'prescription_id' => $request->prescription_id,
                        'history_id' => $new_history->id,
                        'history_value' => $new_history->name_eng,
                    ])->save();
                        $responseData[] = $presHistory;
                }else{

                    $presHistory->fill([
                        'prescription_id' => $request->prescription_id,
                        'history_id' => $value['id'],
                        'history_value' => $value['text'],
                    ])->save();
                    $responseData[] = $presHistory;

                }

            }

                return response()->json($responseData);

        }
        return response()->json(['error'=>'No Previous History Selected !!']);

        


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $history = PrescriptionPrevHistory::where('prescription_id','=',$id)->get();
        if($history->isNotEmpty()){
            return response()->json(['history'=>$history,"success"=>true]);
        }else{
            return response()->json(['history'=>$history,"success"=>false]);
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
        $isExisted = PrescriptionPrevHistory::find($id);
        if($isExisted){
            $isExisted->delete();
        }
        return response()->json(['success' => true]);
    }
    
}