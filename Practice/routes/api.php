<?php

use App\Http\Controllers\OneToOneController;
use App\Http\Controllers\users\userController;
use App\Models\groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware(['cors'])->group(function(){
//     Route::get('/first-getApi',function(){
//         return response()->json(['success'=>true,'message'=>'rram']);
//     });
// });

Route::middleware(['cors','api'])->group(function(){
    Route::post('/registerApi',[userController::class,'registerUser']); 
    Route::post('/loggedUserIn',[userController::class,'LoggedIn']); 
    Route::get('/refreshToken',[userController::class,'refreshToken']); 
    Route::get('/logedout',[userController::class,'logedout']);
    Route::get('/userProfiles',[userController::class,'profilesDetails']);
});
Route::get('/get-groups',[OneToOneController::class,'getGroupsWithMembers']);
Route::get('get-group-with-successor-mutator',function(){
    pp(groups::all()->toArray());

});
 
 

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
