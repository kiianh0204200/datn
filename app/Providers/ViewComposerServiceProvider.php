<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewComposerServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            return;
        }
        $categories = ProductCategory::with('children')->orderBy('id', 'desc')->limit(10)->get();

        view()->share('categories', $categories);

        $banners = Banner::orderBy('id', 'desc')->limit(3)->get();
        view()->composer('frontend.home-components.main-home', function (View $view) use ($banners) {
            $view->with('banners', $banners);
        });

        $colors = ProductOption::where('type', 'color')->get();
        view()->share('colors', $colors);
        $sizes = ProductOption::where('type', 'size')->get();
        view()->share('sizes', $sizes);
    }
}
