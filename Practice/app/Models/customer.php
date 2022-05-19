<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="customer";
    protected $primaryKey="customer_id";


    //MUTATOR
    function setgenderAttribute($value){
        $gender = '';
        if($value=="Male"){
            $gender = 'M';
        }else if($value=="Female"){
            $gender = 'F';
        }else{
            $gender = 'O';
        }
        $this->attributes['gender'] = $gender;
    }

    //Accessor

    function getcreatedAtAttribute($value){
        return date('d-M-Y', strtotime($value));

    }
    function getnameAttribute($value){
        return ucfirst($value);

    }
    function getgenderAttribute($value){
        $gender='';
        if($value=="M"){
            $gender = "Male";
        }elseif($value=="F"){
            $gender = "Female";
        }else{
            $gender="Other";
        }
        return $gender;

    }
}
