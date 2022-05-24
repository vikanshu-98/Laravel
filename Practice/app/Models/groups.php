<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groups extends Model
{
    use HasFactory;

    function members(){
        return $this->hasMany('App\Models\members','group_id','group_id');
    }
}

