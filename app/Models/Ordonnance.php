<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;
    protected $table='ordonnances';

    protected $fillable = [
        'user_id',
        'patient_id'
    ];

    public function orDetail(){
        return $this->hasMany(OrDetail::class,'ordonnance_id');
    }
    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getPatient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
