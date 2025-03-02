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

class CollectionSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        $data['date'] = $date;
        $data['transactions'] = Transaction::where('transaction_date',$date)->get();
        $data['bills'] = BillMain::with('patient')->with('reference')->where('bill_date',$date)->get();
        return view('backend.transactionsummary.index',$data);
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
        $date1 = $request->from_date;
        $date2 = $request->to_date;
        $data['date']=$date;
        $data['date1']=$date1;
        $data['date2']=$date2;

        $data['transactions'] = Transaction::whereBetween('transaction_date',[$date1,$date2])->orderBy('referrence_id','ASC')->get();
        return view('backend.transactionreport.index',$data);
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
