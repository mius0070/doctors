<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'name',
        'birthday',
        'email',
        'username',
        'password',
        'type',
        'service',
        'role',
        'is_visible',
    ];
    public function isAdmin(){
        return $this->type === 0;
    }

    public function isDcotor(){
        return $this->type === 1;
    }

}
