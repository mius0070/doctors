<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrDetail extends Model
{
    use HasFactory;
    protected $table= 'or_details';
    protected $fillable= [
        'med_lib',
        'nbr_p_j',
        'nbr_j',
        'ordonnance_id'

     ];
}
