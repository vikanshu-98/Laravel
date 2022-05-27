<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    function createUser(Request $request){
        
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string|min:5|max:10',
            'confirmP'=>'required|string|same:password'
        ],[
            'confirmP.same'=>'confirm password and password must be a same'
        ]);
        $user=  new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password); 
        $result =$user->save();
        if($result){
            return redirect()->back()->with('success','A user has been successfully register');
        }else{
            return redirect()->back()->with('error','Registration Failed');
        }
    }
    function LogedIn(Request $request){
        
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
       $data=$request->only('email','password');
       if(Auth::attempt($data)){
        return redirect()->to(url('/user/home'));
       } 
        else{
            return redirect()->back()->with('error','Login Failed');
        }
    }
    function logout(){ 
         Auth::guard('web')->logout();
        return redirect()->to(url('/user/home'));
    }

}
