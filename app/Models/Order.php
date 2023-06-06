<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    // use HasTranslations;

    public function delivery_man(){
        return $this->belongsTo(User::class , 'delivery_man_id');
    }
}
