<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

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
        Paginator::useBootstrapFive();

        Blade::directive('datetime', function (string $expression) {
            return "<?php echo ($expression)->format('d/m/Y'); ?>";
        });

        Cookies::essentials()
        ->session()
        ->csrf();

        Cookies::optional()
        ->name('remember_me')
        ->description('This cookie permitt to your session to stay connected for futures visits.')
        ->duration(13 * 30 * 24 * 60); // 13 months
    }
}
