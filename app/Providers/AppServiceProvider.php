<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('No_vue', function ($expression) {
           return '{!!"<div v-pre >'.$expression.'</div>"!!}';
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
  
    
    public function boot()
    {
        
        Schema::defaultStringLength(191);
    }
}
