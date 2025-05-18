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
use App\Models\Backend\Transaction;
use App\Models\Backend\ServiceCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $date = Carbon::now();
        $validated = Validator::make($request->all(),[
            'bill_main_id' => 'required',
        ]);

        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }
        // return $request->all();
        $billMainID = $request->bill_main_id;
        $billMain = BillMain::where('bill_id','=',$billMainID)->where('paid_status','=',0)->first();
        $transactions = Transaction::where('referrence_id','=',$billMainID)->where('service_category_id','=',2)->get();
        if(count($transactions) > 1) return response()->json(["message"=>"Bill Already Have Multiple Payment Entry"]);
        if($billMain){
            $createOrUpdate = BillDetails::where('bill_main_id','=',$billMainID)->exists();
            if($createOrUpdate){
                if(Auth::user()->user_role = "reception") return response()->json(["message"=>"You are not permitted to update Bill Information"]);
                BillDetails::where('bill_main_id','=',$billMainID)->delete();
                $billItems = $request->bill_item;
                // return $request->all();
                $user = Auth::user()->id;

                if(!$request->has('bill_item')) return response()->json(['error'=>"No Data Included"]);
                foreach($billItems as $item){
                    $createObject = new BillDetails();
                    $createObject->bill_main_id = (int)$billMainID;
                    $createObject->patient_id = (int)$billMain->patient_id;
                    $createObject->service_category_id = $request->service_category_id[$item];
                    $createObject->referrence_id = (int)$billMain->referrence_id;;
                    $createObject->item_id = (int)$item;
                    $createObject->bill_date = $date;
                    $createObject->delivery_date = $request->delivery_date[$item];;
                    $createObject->price = $request->amount[$item];
                    $createObject->quantity = $request->quantity[$item];
                    $createObject->final_price = $request->total_payable[$item];
                    $createObject->discount_percent = (int)$request->discount_per[$item];
                    $createObject->discount_amount = (int)$request->discount_amt[$item];
                    $createObject->discountable = (int)$request->discountable[$item];
                    $createObject->updated_by = $user;
                    $createObject->save();

                }
                $billMain->total_amount  = $request->bill_amount;
                $billMain->payable_amount  = $request->bill_total_amount;
                $billMain->discount_percent = $request->bill_in_per;
                $billMain->discount_amount = $request->bill_dis_amt;
                $billMain->paid_amount = $request->bill_paid_amount;
                $billMain->due_amount = $request->bill_due_amount;
                if((int)$request->bill_due_amount <= 0){
                    $billMain->paid_status = true;
                }else{
                    $billMain->paid_status = false;
                }
                $billMain->updated_by = $user;
                $billMain->save();

                $transaction = Transaction::where('referrence_id','=',$billMainID)->where('service_category_id','=',2)->first();

                $transaction->patient_id = (int)$billMain->patient_id;
                $transaction->patient_name = $billMain->patient_name;
                $transaction->referrence_id = (int)$billMainID;
                $transaction->service_category_id = 2;
                $transaction->transaction_date = $date;
                $transaction->prev_due = 0;
                $transaction->prev_paid = 0;
                $transaction->total_amount = $request->bill_amount;;
                $transaction->payable_amount = $request->bill_total_amount;
                $transaction->discount_percent = $request->bill_in_per;
                $transaction->discount_amount = $request->bill_dis_amt;
                $transaction->paid_amount = $request->bill_paid_amount;
                $transaction->due_amount = $request->bill_due_amount;
                $transaction->return_amount = 0;
                $transaction->returned_status = 0;
                if((int)$request->bill_due_amount <= 0){
                    $transaction->paid_status  = true;
                }else{
                    $transaction->paid_status  = false;
                }
                $transaction->updated_by = $user;
                $transaction->save();

                return $billMain;

            }else{
                $billItems = $request->bill_item;
                // return $request->all();
                if(!$request->has('bill_item')) return response()->json(['error'=>"No Data Included"]);
                $user = Auth::user()->id;
                foreach($billItems as $item){

                    $createObject = new BillDetails();
                    $createObject->bill_main_id = (int)$billMainID;
                    $createObject->patient_id = (int)$billMain->patient_id;
                    $createObject->service_category_id = $request->service_category_id[$item];
                    $createObject->referrence_id = (int)$billMain->referrence_id;;
                    $createObject->item_id = (int)$item;
                    $createObject->bill_date = $date->format('Y-m-d');
                    $createObject->delivery_date = $request->delivery_date[$item];;
                    $createObject->price = $request->amount[$item];
                    $createObject->quantity = $request->quantity[$item];
                    $createObject->final_price = $request->total_payable[$item];
                    $createObject->discount_percent = (int)$request->discount_per[$item];
                    $createObject->discount_amount = (int)$request->discount_amt[$item];
                    $createObject->discountable = (int)$request->discountable[$item];
                    $createObject->created_by = $user;
                    $createObject->save();

                }
                $billMain->total_amount  = $request->bill_amount;
                $billMain->payable_amount  = $request->bill_total_amount;
                $billMain->discount_percent = $request->bill_in_per;
                $billMain->discount_amount = $request->bill_dis_amt;
                $billMain->paid_amount = $request->bill_paid_amount;
                $billMain->due_amount = $request->bill_due_amount;
                if((int)$request->bill_due_amount <= 0){
                    $billMain->paid_status = true;
                }else{
                    $billMain->paid_status = false;
                }
                $billMain->save();

                $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
                $lastid = Transaction::where('transaction_id','>',$checkingID)->orderBy('transaction_id', 'desc')->first();

                if($lastid){
                    $transaction_id = $lastid->transaction_id+1;
                }else{
                    $transaction_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
                }
                $transaction = new Transaction();
                $transaction->transaction_id = $transaction_id;
                $transaction->patient_id = (int)$billMain->patient_id;
                $transaction->patient_name = $billMain->patient_name;
                $transaction->referrence_id = (int)$billMainID;
                $transaction->service_category_id = 2;
                $transaction->transaction_date = $date;
                $transaction->prev_due = 0;
                $transaction->prev_paid = 0;
                $transaction->total_amount = $request->bill_amount;;
                $transaction->payable_amount = $request->bill_total_amount;
                $transaction->discount_percent = $request->bill_in_per;
                $transaction->discount_amount = $request->bill_dis_amt;
                $transaction->paid_amount = $request->bill_paid_amount;
                $transaction->due_amount = $request->bill_due_amount;
                $transaction->return_amount = 0;
                $transaction->returned_status = 0;
                if((int)$request->bill_due_amount <= 0){
                    $transaction->paid_status  = true;
                }else{
                    $transaction->paid_status  = false;
                }
                $transaction->created_by = $user;
                $transaction->save();
                return $billMain;
            }

        }
        return response()->json(["message"=>"Bill Already Closed"]);
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
