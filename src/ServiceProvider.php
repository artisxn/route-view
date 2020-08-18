<?php namespace codicastudio;

use Route;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider {

    /**
     * Register.
     *
     * @return
     */
    public function register()
    {
        //
    }

    /**
     * Boot.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config.php', 'route-view'
        );

        if (config('route-view.debug_only', true) && empty(config('app.debug'))) {
            return;
        }

        $this->loadViewsFrom(realpath(__DIR__ . '/../views'), 'route-view');

        $this->publishes([
            __DIR__ . '/../config.php' => config_path('route-view.php')
        ]);

        Route::get(config('route-view.url'), 'codicastudio\RouteViewController@show')
            ->name('route-view.show')
            ->middleware(config('route-view.middlewares'));
    }

}
