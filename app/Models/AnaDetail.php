<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnaDetail extends Model
{
    use HasFactory;
    protected $table='ana_details';
    protected $fillable= [
        'ana_lib',
        'analyse_id'
 
     ];
}
