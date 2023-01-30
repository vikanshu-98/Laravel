<?php

namespace App\Providers;

use App\Macros\ResponseMacros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         
        Response::mixin(new ResponseMacros);
        Request::macro('userName',function(){
            return $this->username??'notSet';
        });
    }
}
