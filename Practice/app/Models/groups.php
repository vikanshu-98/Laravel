<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groups extends Model
{
    use HasFactory;
    protected $primaryKey='group_id';
    protected $hidden =['created_at','updated_at'];
    protected $appends = ['is_group_agra'];

    function members(){
        return $this->hasMany('App\Models\members','group_id','group_id');
    }
    function oneToOne(){
        return $this->hasOne('App\Models\members','group_id','group_id');
    }

    function eagerLoading(){
        return $this->belongsTo('App\Models\members','members','group_id');
    }
    function insertMany(){
        return $this->belongsToMany('App\Models\members')->withPivot('member_id');
    }

    function getNameAttribute($value){
        return ucfirst($value);
    }
    function getIsGroupAgraAttribute(){
        return $this->attributes['name']=='Agra'?true:false;
    }



}

