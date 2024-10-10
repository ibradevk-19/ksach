<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'id_num',
        'wife_name',
        'wife_id_num',
        'family_count',
        'marital_status',
        'mobile',
        'family_id',
        'actor_id',
        'status',
        'is_approved',
        'form_src'
    ];

     public function flamily() {
        return $this->belongsTo(Family::class,'family_id');
     }


     public function actor() {
        return $this->belongsTo(Actor::class,'actor_id');
     }


     public function familyDetailsInfo() {
        return $this->hasOne(FamilyDetailsInfo::class,'beneficial_id','id');
     }


     /**
      * Get all of the comments for the WordFood
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function deliveryRecordBeneficials()
     {
         return $this->hasMany(DeliveryRecordBeneficial::class, 'beneficial_id', 'id');
     }


}
