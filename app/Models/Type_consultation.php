<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_consultation extends Model
{
    use HasFactory;

    protected $table= 'type_consultations';
    protected $fillable=
    [
        'lib',
        'prix',
        'user_id'
    ];
}
