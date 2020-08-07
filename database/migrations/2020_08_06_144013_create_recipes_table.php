<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('recipe_categories', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('ingredients');
            $table->text('preparation');
            $table->string('image');
            $table->foreignId('user_id')->references('id')->on('users')->comment('User who created the recipe');
            $table->foreignId('category_id')->references('id')->on('recipe_categories')->comment('Recipe category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_categories');
        Schema::dropIfExists('recipes');
    }
}
