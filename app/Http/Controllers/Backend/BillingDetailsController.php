<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Service;
use App\Models\Backend\Patients;
use App\Models\Backend\InvestigationEquipment;
use App\Models\Backend\InvestigationEquipSetup;
use App\Models\Backend\BillItems;
use App\Models\Backend\BillMain;
use App\Models\Backend\BillDetails;
use App\Models\Backend\ServiceCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class BillingDetailsController extends Controller
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

        $date = Carbon::now()->format('Y-m-d');
        $validated = Validator::make($request->all(),[
            'bill_main_id' => 'required',
        ]);

        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }
        $billMainID = $request->bill_main_id;
        $billMain = BillMain::where('bill_id','=',$billMainID)->first();
        if($billMain){
            $createOrUpdate = BillDetails::where('bill_main_id','=',$billMainID)->exists();
            if($createOrUpdate){

                return $request->all();
            }else{
                $billItems = $request->bill_item;
                foreach($billItems as $item){
                    $createObject = new BillDetails();
                    $createObject->bill_main_id = (int)$billMainID;
                    $createObject->patient_id = (int)$billMain->patient_id;
                    $createObject->service_category_id = $request->service_category_id[$item];
                    $createObject->referrence_id = (int)$billMain->referrence_id;;
                    $createObject->item_id = (int)$item;
                    $createObject->bill_date = $date;
                    $createObject->price = $request->amount[$item];
                    $createObject->quantity = $request->quantity[$item];
                    $createObject->final_price = $request->amount[$item];
                    $createObject->discount_percent = 0;
                    $createObject->discount_amount = 0;
                    $createObject->save();

                }
                $billMain->total_amount  = $request->bill_amount;
                $billMain->payable_amount  = $request->bill_total_amount;
                $billMain->discount_percent = $request->bill_in_per;
                $billMain->discount_amount = $request->bill_dis_amt;
                $billMain->paid_amount = $request->bill_paid_amount;
                $billMain->due_amount = $request->bill_due_amount;
                $billMain->save();
                return $billMain;
            }

        }
        return $request->all();
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
