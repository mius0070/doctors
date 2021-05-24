<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $table='medicaments';
    protected $fillable=[
        'DCI_COD',
        'DCI_LIB',
        'DCI_SPEC',
        'DCI_PU',
    ];
}
