<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\Translatable\HasTranslations;


class Category extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class , 'category_id');
    }
}
