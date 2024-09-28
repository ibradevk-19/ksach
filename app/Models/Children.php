<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;


    protected $fillable = [
        'beneficial_id','name','gender','identity_number','birth_date',
        'is_disabled','has_chronic_disease','war_victim',
        'is_orphan','is_student','is_graduate','educational_qualification',
    ];

    public function beneficial() {
        return $this->belongsTo(WordFood::class,'beneficial_id');
    }
}
