<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\BrandImage;
class BrandImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['images'] = BrandImage::paginate(5);
        return view('backend.brand.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'age' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }
        $createObject = new BrandImage();
        if($request->file('Image')){
            $imageName = 'brand-image'.time().'-'.mt_rand().'.'.$request->Image->extension();
            $fileName = 'frontend/uploads/images/brand_images/'.$imageName;
            $request->Image->move(public_path('frontend/uploads/images/brand_images/'), $imageName);
            $createObject->Image = $fileName;
        }
        $createObject->Type = $request->Type;
        if($request->Status == 'Y'){
            BrandImage::where('Status','Y')->where('Type','R')->update(['Status'=>'N']);
        }
        $createObject->Status = $request->Status;
        if($request->has('SpecialDate')){
            $createObject->SpecialDate = $request->SpecialDate;
        }

        $createObject->save();

        return back()->with('success','Brand Image Created Successfully');
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

        $data['image'] = BrandImage::find($id);
        return view('backend.brand.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(),[
            'Type' => 'required',
            'Status' => 'required'
        ]);

        return $request->all();
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }
        if(BrandImage::exists($id)){
            if($request->Status == 'Y' && $request->Type =='R'){
                BrandImage::where('Status','Y')->where('Type','R')->update(['Status'=>'N']);
            }
            $createObject = BrandImage::find($id);
            if($request->file('Image')){
                @unlink($createObject->Image);
                $imageName = 'brand-image'.time().'-'.mt_rand().'.'.$request->Image->extension();
                $fileName = 'frontend/uploads/images/brand_images/'.$imageName;
                $request->Image->move(public_path('frontend/uploads/images/brand_images/'), $imageName);
                $createObject->Image = $fileName;
            }
            $createObject->Status = $request->Status;
            $createObject->Type = $request->Type;
            $createObject->SpecialDate = $request->SpecialDate;
            $createObject->save();

            return back()->with('success','Brand Image Updated Successfully');
        }else{
            return back()->with('danger','Brand Image Not Found');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(BrandImage::find($id)){
            $createObject = BrandImage::find($id);
            @unlink($createObject->Image);
            $createObject->delete();
            return back()->with('success','Brand Image Remove Successfully');
        }else{
            return back()->with('danger','Brand Image Not Found');
        }
    }
}
