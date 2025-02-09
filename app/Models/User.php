<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $fillable = ['name', 'email', 'password', 'type'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];
}
