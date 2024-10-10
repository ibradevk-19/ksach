<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model implements  Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'id_num',
        'mobile_num',
        'family_id',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function flamily() {
       return $this->belongsTo(Family::class,'family_id');
    }

}
