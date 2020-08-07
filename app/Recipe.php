<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [
        'title', 'preparation', 'ingredients', 'image','category_id'
    ];

    //gets recipe category via FK
    public function category()
    {
        return $this->belongsTo(RecipeCategory::class);
    }

    //gets user info via FK
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); //FK
    }
}
