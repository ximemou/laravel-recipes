<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipes','RecipeController@index')->name('recipes.index');
Route::get('/recipes/create','RecipeController@create')->name('recipes.create');
Route::post('/recipes', 'RecipeController@store')->name('recipes.store');
Route::get('/recipes/{recipe}','RecipeController@show')->name('recipes.show');
Route::get('/recipes/{recipe}/edit','RecipeController@edit')->name('recipes.edit');
Route::put('/recipes/{recipe}', 'RecipeController@update')->name('recipes.update');
Route::delete('/recipes/{recipe}', 'RecipeController@destroy')->name('recipes.destroy');

Route::get('/profiles/{profile}','ProfileController@show')->name('profiles.show');
Route::get('/profiles/{profile}/edit','ProfileController@edit')->name('profiles.edit');
Route::put('/profiles/{profile}','ProfileController@update')->name('profiles.update');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
