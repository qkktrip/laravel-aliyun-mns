<?php

namespace Qkktrip\LaravelAliyunMNS;

use AliyunMNS\Foundation\AliyunMNSApplication as AliyunMNS;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/config.php');

        if ($this->app instanceof LaravelApplication) {
            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $source => config_path('aliyunmns.php'),
                ]);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AliyunMNS::class, function ($app){
            $aliyunMns = new AliyunMNS(config('aliyunmns'));
            return $aliyunMns;
        });

        $this->app->alias(AliyunMNS::class, 'aliyunmns');
    }
}
