<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRecordBeneficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_record_id',
        'beneficial_id',
        'product_id',
        'status'
    ];


    public function beneficial() {
        return $this->belongsTo(WordFood::class,'beneficial_id');
     }

     public function product() {
        return $this->belongsTo(Product::class,'product_id');
     }
}
