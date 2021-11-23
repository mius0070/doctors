<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CerificatMedical extends Model
{
    use HasFactory;
    protected $table='cerificat_medicals';
    protected $fillable = [
        'nbr_j',
        'date',
        'user_id',
        'patient_id'

    ];
    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getPatient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
