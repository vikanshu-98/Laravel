<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class members extends Model
{
    use HasFactory;


    // one to one 
    function getGroup(){
       return  $this->hasOne('App\Models\groups','group_id');
    }

    // one to many

    function Groups(){
        return $this->hasMany('App\Models\groups','group_id','group_id');
    }

    function oneToMany(){
        return $this->belongsToMany(groups::class,'groups','group_id','group_id');
    }
}
