<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Recipe;

class ProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {

        //get recipes with pagination
        $recipes = Recipe::where('user_id',$profile->user_id)->paginate(10);
        return view('profiles.show',compact('profile','recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view',$profile);
        return view('profiles.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {


        //execute policy
        $this->authorize('update', $profile);

        //validate
        $data=request()->validate([
            'name'=>'required',
            'url'=>'required',
            'biography'=>'required'
        ]);


        //if user uploads image
        if($request['image'])
        {
            $image_path=$request['image']->store('uploaded-profiles','public');
            //resize image
            $img = Image::make(public_path("storage/{$image_path}"))->fit(600,600);
            $img->save();

            //create array
            $array_image = ['image'=>$image_path];

        }


        //assign name and url
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();
        //delete url and name from $data
        unset($data['url']);
        unset($data['name']);

        //store info
        //assign biography and image
        auth()->user()->profile()->update(array_merge(
            $data,
            $array_image ?? []
        ));

        //redirect
        return redirect()->action('RecipeController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
