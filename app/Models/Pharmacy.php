<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory;
    // use HasTranslations;

    public function products(){
        return $this->hasMany(Product::class , 'pharmacy_id');
    }
}
