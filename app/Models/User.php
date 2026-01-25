<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'role',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements');
    }



    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
