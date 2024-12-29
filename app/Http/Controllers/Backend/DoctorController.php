<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Doctors;
use App\Models\Backend\Departments;
use Illuminate\Support\Carbon;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['images'] = Doctors::paginate(5);
        $data['departments'] = Departments::all();

        return view('backend.doctors.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $date = Carbon::now();
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = Doctors::where('doctor_id','>',$checkingID)->orderBy('doctor_id', 'desc')->first();

        if($lastid){
            $doctor_id = $lastid->doctor_id+1;
        }else{
            $doctor_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        // return $patient_id;
        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'degree' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $doctor = new Doctors();
            $doctor->doctor_id = (int)$doctor_id;
            $doctor->fill($request->all())->save();
            return back()->with('success','New Doctor Registered Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Doctors::with('department')->findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['doctor'] = Doctors::find($id);
        return view('backend.doctors.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'degree' => 'required',
        ]);
        if($validated->fails()){
            // return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $doctor = Doctors::find($id);
            $doctor->fill($request->all())->save();
            return back()->with('success','Doctor Information Updated Successfully');
        }

    }
    public function search(Request $request)
    {
        $lastid = Doctors::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Doctors::find($id)){
            $createObject = Doctors::find($id);
            @unlink($createObject->Image);
            $createObject->delete();
            return back()->with('success','Brand Image Remove Successfully');
        }else{
            return back()->with('danger','Brand Image Not Found');
        }
    }
}
