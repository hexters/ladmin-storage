<?php

namespace Hexters\LadminStorage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Publish module
         */
        $this->publishes([
            __DIR__ . '/../stubs/Storage' => base_path('Modules/Storage'),
        ], 'ladmin-storage-module');
    }
}
