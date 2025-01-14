<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ServiceType;
use App\Models\Backend\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['service_types'] = ServiceType::all();
        $data['services'] = Service::paginate(5);

        return view('backend.service.index',$data);
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
            'service_name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $service = new Service();
            $service->fill($request->all())->save();
            return back()->with('success','New Service Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Service::findOrFail($id);
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
            'service_name' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $service = Service::findOrFail($id);
            $data = $request->only(['service_name',
                                    'service_type_id',
                                    'status',
                                    'price',
                                    'discount_per',
                                    'discount_amount',
                                    'final_price']
                                );
            $service->fill($data)->save();
            return back()->with('success','Service '.$service->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Service::find($id)){
            $createObject = Service::find($id);
            $createObject->delete();
            return back()->with('success','Service Remove Successfully');
        }else{
            return back()->with('danger','Service Not Found');
        }
    }
}
