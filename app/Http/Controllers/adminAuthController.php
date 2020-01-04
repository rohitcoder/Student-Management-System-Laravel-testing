<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class adminAuthController extends Controller
{
    public function showLogin(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $validator =  Validator::make($request->all(),[
            'email' => 'required', 
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentails = $request->only('email', 'password');

        // var_dump($credentails);

        if(Auth::attempt($credentails)){
           return view('admin.dashboard');
        }else{
            return redirect()->route('admin.login');
        }

     

    }
}
