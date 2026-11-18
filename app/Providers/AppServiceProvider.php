<?php

namespace App\Providers;

use App\Models\PpdbSetting;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Otomatis arahkan public path jika di cPanel folder public dipindah ke public_html atau subfolder hosting
        $publicPath = null;
        if (env('PUBLIC_PATH') && is_dir(env('PUBLIC_PATH'))) {
            $publicPath = env('PUBLIC_PATH');
        } elseif (! empty($_SERVER['DOCUMENT_ROOT']) && is_dir($_SERVER['DOCUMENT_ROOT']) && realpath($_SERVER['DOCUMENT_ROOT']) !== realpath(base_path())) {
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
        } elseif (is_dir(base_path('../public_html'))) {
            $publicPath = base_path('../public_html');
        } elseif (is_dir(base_path('../../public_html'))) {
            $publicPath = base_path('../../public_html');
        } elseif (is_dir(base_path('public_html'))) {
            $publicPath = base_path('public_html');
        }

        if ($publicPath) {
            $this->app->bind('path.public', fn () => $publicPath);

            if ($this->app instanceof Application) {
                $this->app->usePublicPath($publicPath);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa HTTPS di environment production atau jika diakses lewat reverse-proxy SSL / Cloudflare
        if ($this->app->environment('production') || request()->isSecure() || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

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
