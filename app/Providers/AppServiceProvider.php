<?php

namespace App\Providers;

use App\Models\PpdbSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('ppdb_settings')) {
                    $setting = PpdbSetting::getActive();
                    $view->with('appSetting', $setting);
                    if (! $view->offsetExists('ppdbSetting')) {
                        $view->with('ppdbSetting', $setting);
                    }
                }
            } catch (\Throwable $e) {
                // Ignore gracefully if tables not yet migrated
            }
        });
    }
}
