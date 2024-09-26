<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;


class Admin extends Model implements  Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasRoles,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];





    ######################################################
    ######################  Scopes #######################
    ######################################################



    public function scopeSubAdmin($query){
        return $query->whereNull('type');
    }


    public function getPhotoAttribute(){

        return $this->image ?  Storage::url($this->image) : null ;


    }


}
