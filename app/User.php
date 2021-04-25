<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {  
        return $this->hasMany(Post::class);
    }

    public function isAdmin()
    {
        return $this->username === 'kridospace';  
    }

    // public function gravatar($size = 150)
    // {
    //      return //buang variable gravatar, ganti email ke this->email
    // }
}
