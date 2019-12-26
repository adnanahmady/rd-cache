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
        $this->app->singleton(Directive::class, function() {
            return new Directive(new Cache(app('cache.store')));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('RD\Directive')->setUp($expression)) { ?>";
        });

        Blade::directive('endcache', function() {
            return "<?php } echo app('RD\Directive')->tearDown() ?>";
        });
    }
}
