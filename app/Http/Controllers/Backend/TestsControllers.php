<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Backend\TestsList;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class TestsControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tests'] = TestsList::paginate(20);
        return view('backend.tests.index',$data);
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
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $department = new TestsList();
            $department->fill($request->all())->save();
            return back()->with('success','New Tests Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = TestsList::findOrFail($id);
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
            $department = TestsList::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'name_bang',
                                    'status']
                                );
            $department->fill($data)->save();
            return back()->with('success','Tests '.$department->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(TestsList::find($id)){
            $createObject = TestsList::find($id);
            $createObject->delete();
            return back()->with('success','Tests Remove Successfully');
        }else{
            return back()->with('danger','Tests Not Found');
        }
    }

    public function search(Request $request){
        $search = $request->q;
        $complaint = TestsList::where('name_eng','LIKE','%'.$search.'%')->orWhere('name_bang','LIKE','%'.$search.'%')->get();
        return $complaint;
    }
}
