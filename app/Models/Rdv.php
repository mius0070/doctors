<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    protected $table='rdvs';
    protected $fillable = [
        'note' ,
        'date_rdv' ,
        'patient_id' ,
        'user_id' ,
        'etat'        
    ];

    public function getPatients(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function getDoctor(){
        return $this->belongsTo(User::class,'user_id');
    }
}
