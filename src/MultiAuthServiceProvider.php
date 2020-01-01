<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:30 PM
 */

namespace Anacreation\MultiAuth;


use Anacreation\MultiAuth\Passport\PassportRouteRegister;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MultiAuthServiceProvider extends ServiceProvider
{
    public function boot() {



        $this->loadRoutesFrom(__DIR__ . '/Routes/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Views', 'MultiAuth');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/MultiAuth'),
        ], 'multiAuth');


        $this->publishes([
            __DIR__ . '/config/admin.php' => config_path('admin.php'),
        ], "multiAuth");

        $this->addAdminConfigToAuth();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        $this->registerPassportRoutes();

        $this->loadFactoriesWhenTesting();

    }

    public function register() {
        $this->mergeConfigFrom(
            __DIR__ . '/config/admin.php', 'admin'
        );
    }


    private function addAdminConfigToAuth() {

        $auth_config = config('admin');

        if ($auth_config) {
            config([
                "auth.guards"    => array_merge($auth_config['guards'],
                    config('auth.guards')),
                "auth.providers" => array_merge($auth_config['providers'],
                    config('auth.providers')),
                "auth.passwords" => array_merge($auth_config['passwords'],
                    config('auth.passwords')),
            ]);
        }
    }

    private function registerPassportRoutes(): void {
        $options = [
            'prefix'    => 'oauth',
            'namespace' => '\Laravel\Passport\Http\Controllers',

        ];

        Route::group($options, function ($router) {
            (new PassportRouteRegister($router))->all();
        });
    }

    private function loadFactoriesWhenTesting(): void {
        if (app()->env === 'testing') {
            $path = __DIR__ . '/factories';
            $this->app->make(Factory::class)->load($path);
        }
    }

}