<?php

use App\Events\someOneCheckedYourProfile;
use App\Events\SomeOneCheckYourAccount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commonController;
use App\Http\Controllers\singleActionController;
use App\Http\Controllers\resourceController;
use App\Http\Controllers\UserControllerExport;
use App\Http\Controllers\users\userController;
use App\Jobs\MailCheckQueue;
use App\Jobs\RegisteredUsers;
use App\Mail\FirstMailable;
use App\Mail\secondMailer;
use App\Mail\testingMailable;
use App\Models\groups;
use App\Models\members;
use App\Models\Page;
use App\Models\User;
use App\Notifications\FirstNotification;
use App\Services\FirstServices;
use App\Services\OopsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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



Route::get('/provider',function(\App\Services\FirstServices $firstServices){
    dump($firstServices->returnArray());
    dd(app());
});

// Route::get('/provider',function(){
//     $ob=new FirstServices(12);
//     print_r($ob->returnArray());
// dd(app());
// });

// Route::get('/provider',function(){
//     dd('sdsdsd');
// });

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
Route::get('/uuid',function(){
echo Str::uuid();

});



 

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
    // Route::middleware(['auth:web'])->group(function(){
    //     Route::view('home','dashboard.user.home');
    //    // Route::post('/logout',[userController::class,'logout']);
    // });
}); 


 
Route::get('/contract',function(Illuminate\Contracts\Cache\Factory $cache){
    
    // $cache->put('d','f');
echo $cache->get('d');
});

Route::get('/mail',function(){

    // Mail::send([],[],function($message){
    //     $message->to('vikanshu.chauhan@novoinvent.com','first email')
    //     ->subject('testing mail')->setBody('Hi mail');
    // });
    Mail::to('vikanshu@novo.com')->send(new secondMailer());
    echo "sent";
});


Route::get('/mail',function(){

    // Mail::send([],[],function($message){
    //     $message->to('vikanshu.chauhan@novoinvent.com','first email')
    //     ->subject('testing mail')->setBody('Hi mail');
    // });

    // dispatch(function(){ 
    // })->delay(now()->addSeconds(10)); 
    // RegisteredUsers::dispatch()->delay(now()->addSeconds(20));
    $data=User::inRandomOrder()->first();

    print_r($data->email);
    someOneCheckedYourProfile::dispatch($data);
    $data->notify(new FirstNotification());
    echo "sent" . $data->email;
});



Route::get('send-email',function(){
    Mail::send([],[],function($msg){
        $msg->to('abcd@yopmail.com')->subject('Testing mil')->setBody('sdsdsd');
    });
    echo 'mail sent';
});
Route::get('testingMailable',function(){
    $user = User::inRandomOrder()->get()->first();
     Mail::to($user->email)->send(new testingMailable($user));
     echo 'mail sent';
});

Route::get('checkQueue',function(){
    $user = User::findOrfail(1);
    dispatch(new MailCheckQueue($user))->delay(now()->addSecond(10));
    //MailCheckQueue::dispatch();
    echo 'mail sent';
});
Route::get('eventFire',function(){
    $user = User::findOrfail(1);
    SomeOneCheckYourAccount::dispatch($user);
});
 
Route::get('/',function(Request $request){
 dd($request->userName());
});
Route::get('/getPageWithComment',function(){
 pp(Page::with('comments')->get()->toArray());
  

});
Route::get('/encryption',function(){
  pp(Crypt::encrypt(sha1(10)));
});

Route::get('/storage',function(){
    $content =  Str::random(100); 
});

Route::get('/fileUpload',function(){
    return view('FileUpload');
});

Route::post('/fileUploaded',function(Request $request){
     
     
    //pp(Storage::putFile('avatar',$request->file('uploadFile')));
    // $file=$request->file('uploadFile');
    // $path=time().'_'.$file->getClientOriginalName();
    // pp($request->file('uploadFile')->storeAs('StoreFile',$path));
    $file=$request->file('uploadFile');
   // pp($file->getRealPath());

    Mail::send([],[],function($msg) use($file){
        //pp($request);
        $user  = User::findOrfail(1);
        $msg->to($user->email)->subject('testing body')->setBody('sd');
        $msg->attach($file->getRealPath(),[
            'as'=>$file->getClientOriginalName(),
            'mime'=>$file->getMimeType()
        ]);
    });
    echo 'mail sent';
   // pp(Storage::putFileAs('UploadFile',$file,$path));
});

Route::get('/move',function(Request $request){
    echo "<pre>";
    if($request->path){ 
        print_r("Total Files in $request->path path is:- ".count(glob(base_path("$request->path/").'*',GLOB_ONLYDIR)??0)."\n");
    } 
    if($request->folder && $request->path){ 
        print_r("Total SubFolder  in $request->path  is:- ".count(array_filter(glob(base_path("$request->path/").'*'),'is_file')??0));
    } 
    echo "</pre>";
    //pp(count(array_filter(glob(base_path('app/Http/').'*'),'is_file')??0));
    // pp(array_filter(glob(base_path('app/Http/').'*'),'is_dir'));
    //pp(array_filter(.'*'),'is_file'));
    // pp(glob(Storage::path('/uploadedDates')));
   // Storage::append('File.txt','text is going to append in the file');
    //pp(storage_path().'/logs/laravel.log');
   // Storage::append(storage_path().'/logs/laravel.log', 'Appended Text');
 //Storage::copy('avatar','UploadedDatas');
});


Route::get('/oopsConcept',function(OopsService $oops){
    $oops->myNmae();
    OopsService::getSum(1,2);
    // $oops->getMultiply(2,3);
    // dd(app());
});

Route::get('/export',function(){
return view('export');
});
Route::get('/exportUser',[UserControllerExport::class,'exportUser']);

