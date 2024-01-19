<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.home.category-area', function ($view) {
            $categories = Category::latest()->limit(6)->get(); // Misalnya, Anda ingin mengambil data user saat ini


            $view->with(['categories' => $categories]);
        });
    }
}
