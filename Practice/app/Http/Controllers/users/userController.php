<?php

namespace App\Http\Controllers\users;

use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

    public function __construct(){ 
        $this->middleware('JWTAuth',['except'=>['LoggedIn']]);
    } 
    //
    // function createUser(Request $request){
        
    //     $request->validate([
    //         'name'=>'required|string',
    //         'email'=>'required|email',
    //         'password'=>'required|string|min:5|max:10',
    //         'confirmP'=>'required|string|same:password'
    //     ],[
    //         'confirmP.same'=>'confirm password and password must be a same'
    //     ]);
    //     $user=  new User();
    //     $user->name=$request->name;
    //     $user->email=$request->email;
    //     $user->password=Hash::make($request->password); 
    //     $result =$user->save();
    //     if($result){
    //         return redirect()->back()->with('success','A user has been successfully register');
    //     }else{
    //         return redirect()->back()->with('error','Registration Failed');
    //     }
    // }
    // function LogedIn(Request $request){
        
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required'
    //     ]);
    //    $data=$request->only('email','password');
    //    if(Auth::attempt($data)){
    //     return redirect()->to(url('/user/home'));
    //    } 
    //     else{
    //         return redirect()->back()->with('error','Login Failed');
    //     }
    // }
    // function logout(){ 
    //      Auth::guard('web')->logout();
    //     return redirect()->to(url('/user/home'));
    // }



    function registerUser(Request $request){
        $request->validate([
            'name'=>'required|string|max:100', 
            'email'=>'required|email|unique:users', 
            'password'=>'required|string|min:5|max:10',
            'confirmPassword'=>'required|string|same:password'
        ]);
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password); 
        $result = $user->save();
        if($result){
            return response()->json(['success'=>true,'code'=>'200','message'=>'user has been registerd.'],200);
        }
        else{ 
            return response()->json(['success'=>true,'code'=>'501','message'=>'something went wrong.'],501);
        }
    }

    function LoggedIn(Request $request){
        $request->validate([
            'email'=>'required|email|string',
            'password'=>'required|string'
        ]);
        if(!$token=Auth::attempt( $request->only(['email','password']),true)){
            throw new AppException('unauthroized user'); 
        }  
        return response()->data([
            'access_token'=>$token, 
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]); 
    }

    public function refreshToken(){
        
        return response()->success();
        // if(Auth::check()){ 
        //     return response()->data([ 'token'=> auth()->refresh(),
        //     'token_type'=>'bearer',
        //     'expires_in'=>auth()->factory()->getTTL()*60]);
        // } else{
        //     throw new AppException('unauthroized user'); 
        // }
    }
    public function logedout(){
        Auth::logout();
        return response()->success();
    }

    public function profilesDetails(){

        if(Auth::check()){
            $user = Auth::user();
            return response()->data([$user]);

        }else{
            throw new AppException('User is not loggedIN');
        }
    }
   

}
