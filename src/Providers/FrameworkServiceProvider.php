<?php

namespace AndrykVP\Rancor\Providers;

use Illuminate\Support\ServiceProvider;

class FrameworkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register all the Package's Service Providers
        $this->app->register(EventServiceProvider::class);  
        $this->app->register(AuditServiceProvider::class);  
        $this->app->register(AuthServiceProvider::class);  
        $this->app->register(FactionServiceProvider::class); 
        $this->app->register(ForumsServiceProvider::class); 
        $this->app->register(NewsServiceProvider::class);  
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes and migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
 
        // Add log channel to stack
        $this->app->make('config')->set('logging.channels.swc', [
            'driver' => 'single',
            'path' => storage_path('logs/swc.log'),
            'level' => 'debug',
        ]);

        // Publishes config files
        $this->publishes([
            __DIR__.'/../../config/app.php' => config_path('rancor.php'),
            __DIR__.'/../../config/forums.php' => config_path('rancor.forums.php'),
        ],'config');
    }
}
