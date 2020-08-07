<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class RecipeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recipes = auth()->user()->recipes;
        return view('recipes.index')->with('recipes',$recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get categories without model
        //$categories = DB::table('recipes_category')->get()->pluck('name','id');

        //get categories with model
        $categories = RecipeCategory::all(['id','name']);
        return view('recipes.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'title'=> 'required|min:6',
            'category'=> 'required',
            'preparation'=> 'required',
            'ingredients'=> 'required',
            'image'=> 'required|image'
        ]);

        //get image path
        $image_path=$request['image']->store('uploaded-recipes','public');

        //resize image
        $img = Image::make(public_path("storage/{$image_path}"))->fit(1000,550);
        $img->save();

        //DB stores in db without model
       /*  DB::table('recipes')->insert([
            'title'=>$data['title'],
            'preparation'=>$data['preparation'],
            'ingredients' =>$data['ingredients'],
            'image'=>$image_path,
            'user_id'=>Auth::user()->id,
            'category_id'=> $data['category'],
        ]); */

        //store in db with model
        auth()->user()->recipes()->create([
            'title'=>$data['title'],
            'preparation'=>$data['preparation'],
            'ingredients' =>$data['ingredients'],
            'image'=>$image_path,
            'category_id'=> $data['category'],
        ]);


        //Redirect
        return redirect()->action('RecipeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //$recipe= Recipe::findOrFail($recipe);
        return view('recipes.show',compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $categories = RecipeCategory::all(['id','name']);
        return view('recipes.edit',compact('categories','recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //check policy
        $this->authorize('update',$recipe);

        $data = request()->validate([
            'title'=> 'required|min:6',
            'category'=> 'required',
            'preparation'=> 'required',
            'ingredients'=> 'required',
        ]);
        $recipe->title = $data['title'];
        $recipe->category_id = $data['category'];
        $recipe->preparation = $data['preparation'];
        $recipe->ingredients = $data['ingredients'];

        if(request('image'))
        {
            //get image path
            $image_path=$request['image']->store('uploaded-recipes','public');
            //resize image
            $img = Image::make(public_path("storage/{$image_path}"))->fit(1000,550);
            $img->save();
            $recipe->image=$image_path;
        }



        $recipe->save();

        return redirect()->action('RecipeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //execute policy
        $this->authorize('delete',$recipe);
        $recipe->delete();
        return redirect()->action('RecipeController@index');
    }
}
