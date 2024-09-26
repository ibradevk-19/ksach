<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'invoice_id',
        'quantity',
        'date',
        'unit_id',
        'category_id'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
