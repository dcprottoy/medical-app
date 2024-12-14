<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthenticationController extends Controller
{
    public function login(Request $request){

        $validated = Validator::make($request->all(),[
            'user_id' => 'required',
            'password' => 'required',
        ]);

        if($validated->fails()){
            return back()->with('error','User ID or Password Is missing');
        }

        $requestInput = $request->only(['user_id','password']);
        // $test = Auth::attempt($requestInput);
        $user = User::first();
        if (Auth::attempt($requestInput)) {
        // if ($user) {
        //     Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('home');
        }else{
            return back()->with('error','User ID or Password Is missing');
        }
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
