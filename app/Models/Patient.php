<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table='patients';
    protected $fillable = [
        'f_name' ,
        'l_name' ,
        'birthday' ,
        'gender' ,
        'phone' ,
        'wilaya' ,
        'adresse',
        'group_sang' ,
        'code_archive' ,
        'user_id' ,
    ];

    public function getWilaya(){
        return $this->belongsTo(Wilaya::class,'wilaya');
    }
   
}
