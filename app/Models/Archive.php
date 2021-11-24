<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table = 'archives';
    protected $fillable = [
        'img_url',
        'note',
        'type_radio_id',
        'user_id' ,
        'patient_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getPatient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function getTypeRadio(){
        return $this->belongsTo(TypeRadio::class,'type_radio_id');
    }
}
