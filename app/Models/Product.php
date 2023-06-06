<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\Translatable\HasTranslations;


class Product extends Model
{
    use HasFactory;
    // use HasTranslations;

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class , 'pharmacy_id');
    }
    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function client(){
        return $this->belongsToMany(User::class);
    }
}
