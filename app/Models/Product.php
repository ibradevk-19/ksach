<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'src',
        'quantity',
        'provider_id',
        'category_id',
        'unit_id',
    ];


    public function provider() {
        return $this->belongsTo(Provider::class,'provider_id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
