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

        $bill = new BillMain();
        $bill->bill_id = (int)$bill_id;
        $bill->patient_id = (int)$patient_id;
        $bill->patient_name = $patient_name;
        $bill->referrence_id = 1;
        $bill->bill_date = $date->format('Y-m-d');
        $bill->save();
        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $main = BillMain::with('patient')->where('bill_id',$id)->first();
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

        $main = BillMain::with('patient')->where('bill_id',$id)->first();
        $details = BillDetails::join('bill_items','bill_details.item_id','=','bill_items.id')
        ->where('bill_main_id',$id)
        ->select('bill_details.*','bill_items.item_name','bill_items.price as item_rate')
        ->get();

        // return response()->json(["main"=>$main,"details"=>$details]);

        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $billImg = $generator->getBarcode($main->bill_id, $generator::TYPE_CODE_128);
        $patientImg = $generator->getBarcode($main->patient->patient_id, $generator::TYPE_CODE_128);
        $data = ["main"=>$main,"details"=>$details,'billImg'=>$billImg,'patientImg'=>$patientImg];
        // $data = ['title' => 'domPDF in Laravel 10','img'=>$image];

        // $customPaper = array(0,0,650,1100);
        // $pdf = PDF::setPaper($customPaper,'potrait')->loadView('pdf.document', $data);
        // return view('pdf.document', $data);
        $pdf = PDF::setPaper('A5','potrait')->loadView('pdf.document', $data);

        return $pdf->stream('document.pdf');

    }

    public function search(Request $request)
    {
        $lastid = BillMain::where('bill_id', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
}
