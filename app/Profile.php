<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //1:1 Profile and user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
