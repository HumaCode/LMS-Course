<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
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

        View::composer('frontend.home.course-area', function ($view) {
            $courses = Course::where('status', 1)->orderBy('id', 'ASC')->limit(6)->get(); // Misalnya, Anda ingin mengambil data user saat ini
            $categories = Category::orderBy('category_name', 'ASC')->get(); // Misalnya, Anda ingin mengambil data user saat ini


            $view->with([
                'courses' => $courses,
                'categories' => $categories,
            ]);
        });
    }
}
