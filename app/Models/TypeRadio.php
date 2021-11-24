<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRadio extends Model
{
    use HasFactory;
    protected $table = "type_radios";
    protected $fillable =[
        'lib_radio'
    ];

}
