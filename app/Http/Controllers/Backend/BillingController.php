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
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['patients'] = Patients::orderBy('id','DESC')->limit(20)->get();
        $data['bill_items'] = BillItems::all();
        $data['bill_mains'] = BillMain::orderBy('id','DESC')->limit(50)->get();
        $data['service_category'] = ServiceCategory::whereNotIn('id',[1])->get();
        return view('backend.billing.index',$data);
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
            'patient_id' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }
        $patient = Patients::where('patient_id','=',$request->patient_id)->first();
        $date = Carbon::now();
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = BillMain::where('bill_id','>',$checkingID)->orderBy('bill_id', 'desc')->first();

        if($lastid){
            $bill_id = $lastid->bill_id+1;
        }else{
            $bill_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        $patient_id = $patient->patient_id;
        $patient_name = $patient->name;

        $user = Auth::user()->id;
        $bill = new BillMain();
        $bill->bill_id = (int)$bill_id;
        $bill->patient_id = (int)$patient_id;
        $bill->patient_name = $patient_name;
        $bill->referrence_id = 1;
        $bill->bill_date = $date->format('Y-m-d');
        $bill->created_by = $user;
        $bill->save();
        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $main = BillMain::with('patient')->with('reference')->where('bill_id',$id)->first();
        $details = BillDetails::join('bill_items','bill_details.item_id','=','bill_items.id')
        ->where('bill_main_id',$id)
        ->select('bill_details.*','bill_items.item_name','bill_items.price as item_rate' )
        ->get();

        return response()->json(["main"=>$main,"details"=>$details]);
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

    public function billingitems(string $id){
        $lastid = BillItems::findOrFail($id);
        $equip = InvestigationEquipSetup::with('equip')->where('investigation_main_id','=',$id)->get();

        return response()->json(["equipments"=>$equip,"item"=>$lastid]);
    }

    public function pdf(string $id){

        $main = BillMain::with('patient')->with('reference')->where('bill_id',$id)->first();
        $details = BillDetails::join('bill_items','bill_details.item_id','=','bill_items.id')
        ->leftJoin('investigation_groups','bill_items.investigation_group_id','=','investigation_groups.id')
        ->where('bill_main_id',$id)
        ->select('bill_details.*','bill_items.item_name','bill_items.price as item_rate','investigation_groups.room_no')
        ->get();

        // return response()->json(["main"=>$main,"details"=>$details]);

        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $billImg = $generator->getBarcode($main->bill_id, $generator::TYPE_CODE_128);
        $patientImg = $generator->getBarcode($main->patient->patient_id, $generator::TYPE_CODE_128);
        $data = ["main"=>$main,"details"=>$details,'billImg'=>$billImg,'patientImg'=>$patientImg];
        $taka = (int)$main->paid_amount;
        $data["printed_by"] = $user = Auth::user()->name;
        // return $taka;
        $data['paidinwords'] = $this->convert_number($taka);
        $data['print_date'] =  Carbon::now()->format('Y-m-d');
        $data['menu'] = "billing";
        // $data = ['title' => 'domPDF in Laravel 10','img'=>$image];

        // $customPaper = array(0,0,650,1100);
        // $pdf = PDF::setPaper($customPaper,'potrait')->loadView('pdf.document', $data);
        // return view('pdf.document', $data);
        $pdf = PDF::setPaper('A4','potrait')->loadView('pdf.document', $data);

        return $pdf->stream('document.pdf');

    }

    public function search(Request $request)
    {
        if($request->search== null ){
            $date = Carbon::now()->format('Y-m-d');
            // $bill_mains= BillMain::where('bill_date',$date)->orderBy('id','DESC')->get();
            $bill_mains= BillMain::orderBy('id','DESC')->get();
            return $bill_mains;

        }
        $lastid = BillMain::where('bill_id', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }


    public function billItemSearch(Request $request)
    {


        if($request->search == 0){
            $lastid = BillItems::all();

        }else{
            $lastid = BillItems::where('service_category_id', '=', $request->search)->get();

        }
        return $lastid;
    }


    public function convert_number($number)
    {
        $my_number = $number;

        if (($number < 0) || ($number > 999999999))
        {
        throw new Exception("Number is out of range");
        }
        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000);  /* lakh  */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */

        $res = "";

        if ($Kt)
        {
            $res .= $this->convert_number($Kt) . " Koti ";
        }
        if ($Gn)
        {
            $res .= $this->convert_number($Gn) . " Lakh";
        }

        if ($kn)
        {
            $res .= (empty($res) ? "" : " ") .
                $this->convert_number($kn) . " Thousand";
        }

        if ($Hn)
        {
            $res .= (empty($res) ? "" : " ") .
                $this->convert_number($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
            "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
            "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
            "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
            "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n)
        {
            if (!empty($res))
            {
                $res .= " and ";
            }

            if ($Dn < 2)
            {
                $res .= $ones[$Dn * 10 + $n];
            }
            else
            {
                $res .= $tens[$Dn];

                if ($n)
                {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res))
        {
            $res = "zero";
        }

        return $res;


    }
}
