<?php

namespace App\Providers;

use App\Http\Services\Menu\MenuService;
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
        \View::composer('header', function ($view) {
            $menus = (new MenuService)->all(true);
            $data = [
                'menus' => $menus,
            ];
            $view->with($data);
        });
    }
}
