<?php

namespace App\Providers;

use App\RecipeCategory;
use View;
use Illuminate\Support\ServiceProvider;

class CategoriesProvider extends ServiceProvider
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
        View::composer('*',function($view){
            $categories = RecipeCategory::all();
            $view->with('categories', $categories);
        });
    }
}
