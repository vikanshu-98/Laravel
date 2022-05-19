<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class commonController extends Controller
{
    //
    public function home(){
        return \view('home');
    }
    public function about(){
        return \view('about');
    }
    public function register(Request $request){

        $request->validate([
            'fName'=>'required',
            'email'=>'required|email',
            'namePassword'=>'required|min:3|max:5'
        ],
        [
            'fName.required'=>'*The Name Field is required',
            'email.required'=>'*Email Address is required',
            'namePassword.required'=>'*Password field is required'
        ]
    );
         return $request->all();
    }
} 