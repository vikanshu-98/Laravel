<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\View\View;

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
                'namePassword'=>'required|min:3|max:5',
                'gender'=>'required',
            ],
            [
                'fName.required'=>'*The Name Field is required',
                'email.required'=>'*Email Address is required',
                'namePassword.required'=>'*Password field is required'
            ]

        // $customer  = new customer(); 
        );
        $customer  = new customer(); 
        $customer->name = $request->fName;
        $customer->email = $request->email;
        $customer->password = $request->namePassword;
        $customer->gender  = $request->gender; 
        $customer->save();
        return redirect('customer-list');
    }

    public function customerList(){
        $customer  = new customer();
        $data = $customer->paginate(15);
        $dataArray=compact('data');
        return \view('customer')->with($dataArray);
    }

    public function editData($id){ 
        $data =  customer::find($id);
        if(empty($data)){
            return redirect('customer-list');
        }else{
            $tittle = "Edit Form";
            $action  = "/edit-form-submit/$id";
            $dataArray = compact('data','tittle','action');
            return \view('register')->with($dataArray);
        }
    }
    public function editFormDataSave($id,Request $request){  
        
        $customer  = customer::find($id); 
        $customer->name = $request->fName;
        $customer->email = $request->email;
        $customer->password = $request->namePassword;
        $customer->gender  = $request->gender;
        $customer->save();
        return redirect('customer-list');

    }

    public function deleteData($id){
        $customer  = customer::find($id); 
        if(empty($customer)){
            return redirect('customer-list');
        }else{
            $customer->delete();
            return redirect('customer-list');
        }
    }
    public function moveTrash(){
        $customer  = new customer();
        $data = $customer->onlyTrashed()->get();
        $dataArray=compact('data');
        return \view('trash')->with($dataArray);
    }
    public function Restore($id){
        $customer  =customer::withTrashed()->find($id)->restore(); 
        return redirect('move-trash');
    }
    public function permanentdelete($id){
        $customer  =customer::withTrashed()->find($id)->forceDelete(); 
        return redirect('move-trash');
    }

    public function addSession(Request $req){
        // $req->session()->put('user_id',1);
        // $req->session()->put('email','a@gmail.com');
        session(['user_id'=>1,'user_email'=>'a@gmial.com']);
        session()->flash('success',true);
       return  redirect('getSession');
    }
    public function deleteSession(Request $req){
        // $req->session()->flush();
        session()->forget(['user_id','user_email']);
       return  redirect('getSession');
    }

    public function Searching(Request $request){
        $searchQuery = $request['search']??"";

        $customer = new customer();
        $data=  $customer->where('name','LIKE',"%$searchQuery%")->orWhere('email',"LIKE","%$searchQuery%")->get();
        $dataArray=compact('data');
        return \view('customer')->with($dataArray);
    }
} 