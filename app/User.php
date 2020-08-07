<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //events that executes when a user is created

    protected static function booted()
    {
        parent::boot();
        //asign profile when a new user is created
        static::created(function($user){
            $user->profile()->create();
        });
    }

    //**  1:n User-Recipe */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    //1:1 user and profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

}
