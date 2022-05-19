<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commonController;
use App\Http\Controllers\singleActionController;
use App\Http\Controllers\resourceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


// using controller



Route::get('/',[commonController::class,'home']);
Route::get('/about-us',[commonController::class,'about']);
Route::get('/invoke',singleActionController::class);
Route::resource('/resource',resourceController::class);



Route::get('/register',function(){
    return view('register');
});

Route::post('/formData',[commonController::class,'register']);





// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/{name}', function ($name) {
//     $array = compact('name');
//     return view('second')->with($array);
// });

Route::get('/first/{name}/{address?}', function ($name, $address = null) {
    $head = "<h1>This is the heading</h1>";
    $array = compact('name', 'address', 'head');

    return view('first')->with($array);
});
