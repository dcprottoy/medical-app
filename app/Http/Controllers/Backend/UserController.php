<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error','Please Complete The Form Properly !')->withInput();
        }
        $data = $request->all();
        $model = new User();
        $model->name = $data['name'];
        $model->user_id = $data['user_id'];
        if($request->has('user_role')){
            $model->user_role = $data['user_role'];
        }
        $model->password = Hash::make($data['password']);
        $model->save();
        return redirect()->route('home');


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
}
