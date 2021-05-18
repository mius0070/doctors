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
        'type_cons',
        'patient_id' ,
        'user_id' ,
        'etat',
        'made_by'        
    ];

    public function getPatients(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function getDoctor(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getTypeCons(){
        return $this->belongsTo(Type_consultation::class,'type_cons');
    }
}
