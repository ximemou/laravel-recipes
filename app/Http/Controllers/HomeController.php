<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\RecipeCategory;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        //Show recipes by number of votes
        //$voted= Recipe::has('likes','>',0)->get();
        $voted = Recipe::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();

        // GET 5 NEWEST RECIPES
        //$new = Recipe::orderBy('created_at','DESC')->get();
        //is the same that the previous line
        $newest = Recipe::latest()->take(5)->get();

        // get recipe categories
        $categories = RecipeCategory::all();
        //group recipes by category
        $recipes = [];
        foreach($categories as $category){
            $recipes[ Str::slug($category->name)][] = Recipe::where('category_id', $category->id)->take(3)->get();
        }

        return view('home.index',compact('newest','recipes','voted'));
    }
}
