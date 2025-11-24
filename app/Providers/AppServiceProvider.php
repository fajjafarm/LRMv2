<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;     // ? This was missing!
use Illuminate\Support\Facades\Schema;

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
        // Fix MySQL 5.7 identifier length limit
        Schema::defaultStringLength(191);

        // Fix polymorphic index names being too long
        Blueprint::macro('morphs', function ($name, $indexName = null) {
            $this->string("{$name}_type", 191)->nullable();
            $this->unsignedBigInteger("{$name}_id")->nullable();

            $indexName = $indexName ?: "{$name}_type_{$name}_id_index";

            // Shorten if longer than 64 characters
            if (strlen($indexName) > 64) {
                $indexName = substr($indexName, 0, 30) . '_' . substr(md5($indexName), 0, 10);
            }

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        });
    }  // ? This closing brace was missing in your version!
}