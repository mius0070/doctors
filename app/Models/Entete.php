<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entete extends Model
{
    use HasFactory;
    protected $table='entetes';
    protected $fillable=[
        
            'code_etablissement',
            'titre',
            'desc',
            'adresse',
            'wilaya',
            'phone',
            'fax',
            'email',
            'logo'
        
    ];
}
