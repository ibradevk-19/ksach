<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'id_num',
        'mobile_num',
        'family_id'
    ];


    public function flamily() {
       return $this->belongsTo(Family::class,'family_id');
    }

}
