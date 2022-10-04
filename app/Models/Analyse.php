<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    use HasFactory;
    protected $table='analyses';
    protected $fillable = [
        'user_id',
        'patient_id',
        'note'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getPatient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
