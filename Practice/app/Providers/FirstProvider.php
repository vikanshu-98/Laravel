<?php

namespace App\Providers;

use App\Services\FirstServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FirstProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind(FirstServices::class,function(){
           return new FirstServices(rand(0,100));
        });
    }

    public function provides()
    {
        return [FirstServices::class];
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
