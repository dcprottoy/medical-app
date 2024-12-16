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
use Illuminate\Support\Carbon;
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
        $data['complaints'] = Complaint::where('status',TRUE)->get();
        $data['complaintdurations'] = ComplaintDuration::where('status',TRUE)->get();
        $data['diagnosis'] = Diagnosis::where('status',TRUE)->get();
        return view('backend.appointed.indexLatest',$data);
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
                        ->orderBy('appoinments.serial','ASC')
                        ->get();
        return $appoinmentInfo;
    }
}
