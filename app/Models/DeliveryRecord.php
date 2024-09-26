<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'name'
    ];

    public function records() {
        return $this->hasMany(DeliveryRecordBeneficial::class,'delivery_record_id');
     }
 
    
}
