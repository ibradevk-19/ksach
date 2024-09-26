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
        'status'
    ];

    public function flamily() {
        return $this->belongsTo(Family::class,'family_id');
     }
 

     public function actor() {
        return $this->belongsTo(Actor::class,'actor_id');
     }
}
