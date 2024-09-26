<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use App\Service;
// use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        
        // $this->app->bind(Service::class, function ($app) {
        //     return new Service($app['request']);
        // });
         
        // $this->app->singleton(Service::class, function ($app) {
        //     return new Service(fn () => $app['request']);
        // });

        // $this->app->bind(Service::class, function ($app) {
        //     return new Service($app);
        // });
         
        // $this->app->singleton(Service::class, function () {
        //     return new Service(fn () => Container::getInstance());
        // });

        // $this->app->bind(Service::class, function ($app) {
        //     return new Service($app->make('config'));
        // });
         
        // $this->app->singleton(Service::class, function () {
        //     return new Service(fn () => Container::getInstance()->make('config'));
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Amman');
        Paginator::defaultView('vendor.pagination.custom');
    }
}
