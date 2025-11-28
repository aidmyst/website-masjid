<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    use Illuminate\Support\Facades\File;

    public function boot()
    {
        $source = storage_path('app/public');
        $destination = base_path('../public_html/storage');
    
        if (File::exists($source) && File::exists(dirname($destination))) {
            File::copyDirectory($source, $destination);
        }
    }

}
