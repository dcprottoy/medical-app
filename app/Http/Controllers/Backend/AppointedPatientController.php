<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Patients;
use App\Models\Backend\Appoinments;
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

        $appoinmentInfo = Appoinments::join('patients','appoinments.patient_id','=','patients.patient_id')
                        ->join('doctors','appoinments.doctor_id','=','doctors.doctor_id')
                        ->select('appoinments.*','patients.*')
                        ->where('appoinments.appointed_date',$date)
                        ->orderBy('appoinments.serial','ASC')
                        ->get();
        return $appoinmentInfo;
    }
}
