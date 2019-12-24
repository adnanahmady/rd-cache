<?php

namespace RD;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RDServiceProvider extends ServiceProvider
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
        Blade::directive('cache', function ($expression) {
            return "<?php if (! RD\Caching\RussianDolls::setUp($expression)) { ?>";
        });

        Blade::directive('endcache', function() {
            return "<?php } echo RD\Caching\RussianDolls::tearDown() ?>";
        });
    }
}
