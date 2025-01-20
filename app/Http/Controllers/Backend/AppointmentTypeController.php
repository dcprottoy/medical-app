<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\AppointmentType;
use Illuminate\Support\Carbon;


class AppointmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['examinations'] = AppointmentType::paginate(5);
        return view('backend.appointmenttype.index',$data);
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
            $advice = new AppointmentType();
            $advice->fill($request->all())->save();
            return back()->with('success','New Appointment Type Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = AppointmentType::findOrFail($id);
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
            $advice = AppointmentType::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'name_bang',
                                    'status']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Appointment Type '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(AppointmentType::find($id)){
            $createObject = AppointmentType::find($id);
            $createObject->delete();
            return back()->with('success',' Appointment Type Remove Successfully');
        }else{
            return back()->with('danger',' Appointment Type Not Found');
        }
    }
}
