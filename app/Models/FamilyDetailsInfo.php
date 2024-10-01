<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetailsInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficial_id','male_count', 'female_count', 'children_under_2',
        'children_under_3', 'children_5_to_16', 'marital_status', 'document',
        'is_breadwinner_disabled', 'has_chronic_disease', 'war_victim',
        'income_source', 'average_income', 'is_employee','province', 'city', 'housing_complex',
        'neighborhood', 'street', 'nearest_landmark', 'is_displaced', 'is_owner',
        'housing_type', 'housing_condition', 'war_damage', 'damage_type','repair_status'
    ];

    public function beneficial() {
        return $this->belongsTo(WordFood::class,'beneficial_id');
     }
}
