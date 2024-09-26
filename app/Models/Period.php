<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficial_id',
        'product_id',
        'quantity',
        'date',
        'status',
        'type'
    ];


    public function beneficial() {
        return $this->belongsTo(WordFood::class,'beneficial_id');
     }

     public function product() {
        return $this->belongsTo(Product::class,'product_id');
     }
}
