<?php

namespace App\Http\Controllers;

use App\RecipeCategory;
use Illuminate\Http\Request;
use App\Recipe;

class CategoriesController extends Controller
{
    public function show(RecipeCategory $recipeCategory)
    {
        $recipes = Recipe::where('category_id',$recipeCategory->id)->paginate(2);
        return view('categories.show', compact('recipes','recipeCategory'));
    }
}
