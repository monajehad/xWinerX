<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
   
    public function boot()
{
    Schema::defaultStringLength(191);

    Blade::directive('hideCardNumber', function ($expression) {
        return "<?php echo str_repeat('*', strlen($expression) - 4) . substr($expression, -4); ?>";
    });
}
}
