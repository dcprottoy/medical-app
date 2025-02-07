<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\BillReference;
use App\Models\Backend\BillMain;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;

class BillReferenceControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['bill_references'] = BillReference::paginate(5);
        return view('backend.billreference.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();

            $date = Carbon::now();
            $checkingID = (int)strval($date->year).'0000';
            $lastid = BillReference::where('reference_id','>',$checkingID)->orderBy('reference_id', 'desc')->first();

            if($lastid){
                $reference_id = $lastid->reference_id+1;
            }else{
                $reference_id = strval($date->year).'0001';
            }
            $user = Auth::user()->id;
            $inv_type = new BillReference();
            $inv_type->reference_id = $reference_id;
            $inv_type->created_by = $user;
            $inv_type->fill($request->all())->save();
            return back()->with('success','New Bill Reference Created Successfully');

        }
    }

    public function addBillReference(Request $request)
    {

        if($request->add_type==1){
            $validated = Validator::make($request->all(),[
                'reference_id' => 'required',
                'bill_main_id' => 'required',
                'reference_name' => 'required',
            ]);
            if($validated->fails()){
                return back()->with('error','Something went wrong !!')->withInput();
                // return back()->withErrors($validated)->withInput();
            }else{
                $bill = BillMain::where('bill_id','=',$request->bill_main_id)->first();
                $bill->referrence_id = $request->reference_id;
                $bill->save();
                return response()->json(['success'=>'Reference Added Successfully']);
            }
        }elseif($request->add_type==2){
            $validated = Validator::make($request->all(),[
                'name_eng' => 'required',
                'bill_main_id' => 'required',
            ]);
            if($validated->fails()){
                return back()->with('error','Something went wrong !!')->withInput();

            }else{

                $date = Carbon::now();
                $checkingID = (int)strval($date->year).'0000';
                $lastid = BillReference::where('reference_id','>',$checkingID)->orderBy('reference_id', 'desc')->first();
                if($lastid){
                    $reference_id = $lastid->reference_id+1;
                }else{
                    $reference_id = strval($date->year).'0001';
                }
                try{
                    $user = Auth::user()->id;
                    $bill_reference = new BillReference();
                    $bill_reference->reference_id = $reference_id;
                    $bill_reference->created_by = $user;
                    $bill_reference->fill($request->all())->save();
                }catch(\Exception $e) {
                    return response()->json(["error"=>'Patient Created Failed',"message"=>$e->getMessage()]);
                }

                $bill = BillMain::where('bill_id','=',$request->bill_main_id)->first();
                $bill->referrence_id = $bill_reference->reference_id;
                $bill->save();
                return response()->json(['success'=>'Reference Added Successfully','data' =>$bill_reference]);

            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = BillReference::findOrFail($id);
        return $lastid;
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
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $inv_type = BillReference::findOrFail($id);
            $user = Auth::user()->id;
            $data = $request->only(['name_eng',
                                    'status']
                                );
            $inv_type->updated_by = $user;
            $inv_type->fill($data)->save();
            return back()->with('success','Bill Reference '.$inv_type->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(BillReference::find($id)){
            $createObject = BillReference::find($id);
            $createObject->delete();
            return back()->with('success',' Bill Reference Remove Successfully');
        }else{
            return back()->with('danger',' Bill Reference Not Found');
        }
    }

    public function search(Request $request)
    {
        $lastid = BillReference::where('reference_id', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
}
