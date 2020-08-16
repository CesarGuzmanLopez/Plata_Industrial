<?php

namespace App\Providers;


use Illuminate\View\Engines\CompilerEngine;


use Illuminate\View\ViewServiceProvider; 
use HTMLMin\HTMLMin\Compilers\MinifyCompiler;

class MinifiedViewServiceProvider extends ViewServiceProvider
{
    public function registerBladeEngine($resolver)
    { 
      
        $this->app->singleton('blade.compiler', function ($app) { 
            $blade = $app['htmlmin.blade'];
            $files = $app['files'];
            $storagePath = $app->config->get('view.compiled');
            $ignoredPaths = $app->config->get('htmlmin.ignore', []);  
            return new MinifyCompiler($blade, $files, $storagePath, $ignoredPaths);
        });
        $resolver->register('blade', function () {
            return new CompilerEngine($this->app['blade.compiler']);
        });
    }
}
