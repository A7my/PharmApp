<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\Translatable\HasTranslations;


class Cart extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
