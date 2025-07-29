<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Patients;
use App\Models\Backend\Appoinments;
use App\Models\Backend\AppointmentType;
use App\Models\Backend\Complaint;
use App\Models\Backend\ComplaintDuration;
use App\Models\Backend\Diagnosis;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use PDF;
use App\Models\Backend\PrescriptionMain;
use App\Models\Backend\PrescriptionOnExamination;
use App\Models\Backend\PrescriptionInvestigation;
use App\Models\Backend\PrescriptionComplaint;
use App\Models\Backend\PrescriptionDiagnosis;
use App\Models\Backend\PrescriptionMedicines;
use App\Models\Backend\PrescriptionPrevHistory;
use App\Models\Backend\PrescriptionReferred;
use App\Models\Backend\PrescriptionAdvice;







use Illuminate\Support\Facades\DB;
class AppointedPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['doctors'] = Doctors::all();
        $data['patients'] = Patients::orderBy('id','DESC')->limit(20)->get();
        $data['appointmenttypes'] = AppointmentType::where('status',TRUE)->get();
        return view('backend.appointed.index',$data);
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
        //
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

    public function patientList(string $id){

        $date = Carbon::now()->format('Y-m-d');
        $appoinmentInfo = Appoinments::with('patient')
                        ->where('appoinments.appointed_date',$date)
                        ->where('appoinments.doctor_id',$id)
                        ->where('appoinments.visited',0)
                        ->orderBy('appoinments.serial','ASC')
                        ->get();

        return $appoinmentInfo;
    }


    public function prescribedList(string $id){

        $date = Carbon::now()->format('Y-m-d');
        $appoinmentInfo = Appoinments::with('patient')
                        ->where('appoinments.appointed_date',$date)
                        ->where('appoinments.doctor_id',$id)
                        ->where('appoinments.visited',"!=",0)
                        ->orderBy('appoinments.serial','ASC')
                        ->get();

        return $appoinmentInfo;
    }


    public function print(string $id){

        $main = PrescriptionMain::where('prescription_id','=',$id)->first();
        $investigations = PrescriptionInvestigation::where('prescription_id','=',$id)->get();
        $onexam = PrescriptionOnExamination::where('prescription_id','=',$id)->first();
        $complain = PrescriptionComplaint::where('prescription_id','=',$id)->get();
        $diagnosis = PrescriptionDiagnosis::where('prescription_id','=',$id)->get();
        $medicins = PrescriptionMedicines::where('prescription_id','=',$id)->get();
        $advices = PrescriptionAdvice::where('prescription_id','=',$id)->get();
        $history = PrescriptionPrevHistory::where('prescription_id','=',$id)->get();

        
        // return $prescription;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $billImg = $generator->getBarcode($main->prescription_id, $generator::TYPE_CODE_128);
        $patientImg = $generator->getBarcode($main->patient_id, $generator::TYPE_CODE_128);
        $data = ["main"=>$main,'billImg'=>$billImg,'patientImg'=>$patientImg,'investigations'=>$investigations,'onexam'=>$onexam,'complain'=>$complain,'diagnosis'=>$diagnosis,'medicins'=>$medicins,'advices'=>$advices,'history'=>$history];
       
        $data["printed_by"] = $user = Auth::user()->name;
        // return $taka;
        
        $data['print_date'] =  Carbon::now()->format('Y-m-d');
        $data['menu'] = "billing";
        // $data = ['title' => 'domPDF in Laravel 10','img'=>$image];

        // $customPaper = array(0,0,650,1100);
        // $pdf = PDF::setPaper($customPaper,'potrait')->loadView('pdf.document', $data);
        // return view('pdf.document', $data);
        $pdf = PDF::setPaper('A4','potrait')->loadView('prescription.document', $data);

        return $pdf->stream('document.pdf');




    }
}
