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
        $this->middleware('auth',['except'=>['show','search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        //$recipes = auth()->user()->recipes;

        //with pagination
        $recipes = Recipe::where('user_id', $user->id)->paginate(4);

        return view('recipes.index')->with('recipes',$recipes)->with('user',$user);
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
        //get if user likes actual recipe and if is logued
        $like = (auth()->user()) ? auth()->user()->iLike->contains($recipe->id)  :false;

        // send to the view the amount of likes
        $likes = $recipe->likes->count();

        return view('recipes.show',compact('recipe','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $this->authorize('view', $recipe);
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

    public function search(Request $request)
    {

        $search = $request->get('search');
        $recipes = Recipe::where('title','like','%'.$search.'%')->paginate(10);
        $recipes->append(['search'=>$search]);
        return view('searches.show', compact('recipes','search'));
    }
}
