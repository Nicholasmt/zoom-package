<?php

namespace Nicholasmt\ZoomLibrary\Providers;

use Illuminate\Support\ServiceProvider;

class ZoomProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->publishes([ __DIR__.'/../Controllers' => app_path('Http/nicholasmt/'),], 'library-controller');
        // $this->info('packed publshed');
        $this->publishes([ __DIR__.'/../php-jwt-master' => app_path('Http/nicholasmt/php-jwt-master/'),], 'jwt-master');

        
             
     

    }
}
