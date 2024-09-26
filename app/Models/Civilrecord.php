<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civilrecord extends Model
{
    use HasFactory;
    
    protected $connection = 'sqlite';

    protected $table = 'civilrecord';

    protected $fillable = [
        'ID',''
    ];
}
