<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commonController;
use App\Http\Controllers\singleActionController;
use App\Http\Controllers\resourceController;
use App\Http\Controllers\users\userController;
use App\Models\groups;
use App\Models\members;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
    $tittle = "Registration Form";
    $action  = "/formData";
    $data='';
    $dataArray = compact('data','tittle','action');
    return view('register')->with($dataArray);
});
Route::get('/customer-list',[commonController::class,'customerList'])->middleware(['guard']); 
Route::post('/formData',[commonController::class,'register']); 
Route::post('//edit-form-submit/{id}',[commonController::class,'editFormDataSave']); 
Route::get('/edit-data/{id}',[commonController::class,'editData']);
Route::get('/delete/{id}',[commonController::class,'deleteData']);
Route::get('/move-trash',[commonController::class,'moveTrash']);
Route::get('/restore/{id}',[commonController::class,'Restore']);
Route::get('/permanentdelete/{id}',[commonController::class,'permanentdelete']);
Route::get('/getSession',function(){
    return session()->all();
});


// searching
Route::post('/searching',[commonController::class,'Searching']);



 

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





Route::get('/one-one',function(){ 
   return members::with('getGroup')->get();
});
Route::get('/one-many',function(){ 
    return members::with('Groups')->get();
 });
 Route::get('/one-many-groups',function(){ 
    return groups::with('members')->get();
 });

 Route::get('/login',function(){
    session(['user_id'=>1]);
});
 

Route::get('/noaccess',function(){
    return "you are allowed to access this page";
});


// session

Route::get('/login',[commonController::class,'addSession']);
Route::get('/logout',[commonController::class,'deleteSession']);
Route::get('/getSession',function(){
    return session()->all();
});



//localisatiom

Route::get('/localization/{lang}',function($lang){
    App::setlocale($lang);
    return view('localization');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
       Route::post('/create',[userController::class,'createUser'])->name('create');
       Route::post('/logined',[userController::class,'LogedIn'])->name('logedIn');
        
    });
    Route::middleware(['auth:web'])->group(function(){
        Route::view('home','dashboard.user.home');
        Route::post('/logout',[userController::class,'logout']);
    });
}); 
