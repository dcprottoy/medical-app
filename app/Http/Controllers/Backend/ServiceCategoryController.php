<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ServiceCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['service_category'] = ServiceCategory::paginate(5);
        return view('backend.servicecategory.index',$data);
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

            $user = Auth::user()->id;
            $service_category = new ServiceCategory();
            $service_category->created_by = $user;
            $service_category->fill($request->all())->save();
            return back()->with('success','New Service Category Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = ServiceCategory::findOrFail($id);
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

            $user = Auth::user()->id;
            $service_category = ServiceCategory::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'status']
                                );
            $service_category->updated_by = $user;
            $service_category->fill($data)->save();
            return back()->with('success','Service Category '.$service_category->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(ServiceCategory::find($id)){
            $createObject = ServiceCategory::find($id);
            $createObject->delete();
            return back()->with('success','Service Category Remove Successfully');
        }else{
            return back()->with('danger','Service Category Not Found');
        }
    }
}
