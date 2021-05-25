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
    protected $fillable = [
        'name',
        'username',
        'password',
        'lahir',
        'jk',
        'alamat',
        'hp',
        'role',
        'foto',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function persilangan()
    {
        return $this->hasOne('App\Models\persilangan');
    }

    public function panen()
    {
        return $this->hasOne('App\Models\panen');
    }

    public function proses()
    {
        return $this->hasOne('App\Models\proses');
    }

    public function eksternal()
    {
        return $this->hasOne('App\Models\Eksternal');
    }
}
