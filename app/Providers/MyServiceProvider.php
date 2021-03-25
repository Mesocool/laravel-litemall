<?php

namespace App\Providers;

use App\Services\AddressService;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;

class MyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 用户服务
        $this->app->singleton('userService', function () {
            return new UserService();
//            return UserService::getInstance();
        });
        $this->app->singleton('addressService', function () {
            return new AddressService();
//            return UserService::getInstance();
        });
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
