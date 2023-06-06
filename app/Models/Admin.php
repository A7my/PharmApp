<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;




class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasTranslations;
    protected $fillable = [
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

}
