<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

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
        // HTTPSでアクセスされる場合にURLをHTTPSで生成
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // エラーログの強化
        \DB::listen(function($query) {
            Log::info('SQL実行', [
                'query' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time
            ]);
        });
    }
}
