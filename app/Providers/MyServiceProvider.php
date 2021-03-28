<?php

namespace App\Providers;

use App\Services\Goods\BrandService;
use App\Services\Goods\CatalogService;
use App\Services\Goods\GoodsService;
use App\Services\SearchService;
use App\Services\User\AddressService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

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
        });
        $this->app->singleton('addressService', function () {
            return new AddressService();
        });
        $this->app->singleton('catalogService', function () {
            return new CatalogService();
        });
        $this->app->singleton('brandService', function () {
            return new BrandService();
        });
        $this->app->singleton('goodsService', function () {
            return new GoodsService();
        });
        $this->app->singleton('searchService', function () {
            return new SearchService();
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
