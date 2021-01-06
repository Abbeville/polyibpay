<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::directive('mon', function ($money) {
            return "<?php echo '₦ ' . number_format($money, 2); ?>";
        });

        //register observers
        /*$observers = ['Wallet'];
        foreach ($observers as $c) {
            ("App\\Models\\$c")::observe("App\\Observers\\{$c}Observer");
        }*/
    }
}
