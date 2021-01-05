<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;
use DB;

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

        if (Schema::hasTable('settings')) {
            config([
            'global' => DB::table('settings')->get()
                    ->keyBy('key')
                    ->transform(function ($setting) {
                        return ['name' => $setting->name, 'value' => $setting->value, 'description' => $setting->description];
                    })->toArray()
            ]);
        }
    }
}
