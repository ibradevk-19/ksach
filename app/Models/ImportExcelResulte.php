<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportExcelResulte extends Model
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
        'reson',
        'reson_one',
        'reson_tow',
        'reson_th',
        'actor_id'
    ];
}
