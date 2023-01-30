<?php

namespace App\Http\Controllers;

use App\Models\groups;
use App\Models\members;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class OneToOneController extends Controller
{
    
    public static function getGroupsWithMembers(){
        //pp(groups::with('oneToOne')->get()->toArray());
        $groups=groups::all();
//         $groups->load('eagerLoading');
// pp($groups->toArray());
        $members=members::findOrfail(1);
        pp($members->oneToMany()->attach($members,['name'=>'vikas','email'=>'abce@yopmail.com','desc'=>'sdsd']));

        //pp(groups::with('eagerLoading')->get()->toArray());
    }
}
