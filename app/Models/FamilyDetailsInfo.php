<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetailsInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficial_id','province','city','housing_complex','neighborhood',
        'street','nearest_landmark','is_displaced','is_owner','housing_type',
        'war_damage','damage_type','male_count','female_count','children_under_2',
        'children_under_3','children_5_to_16','document','is_breadwinner_disabled',
        'has_disability','disability_type','has_chronic_disease','war_victim',
        'income_source','average_income','is_employee','marital_status','province_id',
        'city_id','housing_complex_id'
    ];

    public function beneficial() {
        return $this->belongsTo(WordFood::class,'beneficial_id');
     }
}



























