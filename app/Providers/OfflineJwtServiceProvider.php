<?php

namespace App\Providers;

use App\Guards\OfflineJwtGuard;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

class OfflineJwtServiceProvider extends LaravelServiceProvider
{
    /**
     * Extend Laravel's Auth.
     *
     * @return void
     */
    // protected function extendAuthGuard()
    // {
    //     $this->app['auth']->extend('jwt', function ($app, $name, array $config) {
    //         $guard = new OfflineJwtGuard(
    //             $app['tymon.jwt'],
    //             $app['auth']->createUserProvider($config['provider']),
    //             $app['request']
    //         );

    //         $app->refresh('request', $guard, 'setRequest');

    //         return $guard;
    //     });
    // }
}
