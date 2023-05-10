<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserControllerExport extends Controller
{
    //
    public static function exportUser(){
        return Excel::download(new UsersExport,'user.xlsx');
    }

}
