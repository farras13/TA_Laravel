<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persilangan extends Model
{
    protected $table = 'persilangan';
    // public $timestamps = false;
    protected $primaryKey = 'kodePersilangan';
    protected $fillable = [
        'kodePersilangan',
        'tanggal',
        'seed',
        'pollen',
        'status_pk',
        'status_pb',
        'status_trans',
        'status_trans2',
        'status_trans3',
        'calon_kode',
        'calon_nama',
        'calon_gen',
        'calon_jk',
        'idAuth',
    ];

    public function tanaman()
    {
        return $this->belongsTo('App\Models\tanaman', 'seed');
    }

    public function tanamann()
    {
        return $this->belongsTo('App\Models\tanaman', 'pollen');
    }

    public function panen()
    {
        return $this->hasOne('App\Models\panen');
    }

    public function proses()
    {
        return $this->hasOne('App\Models\proses');
    }

    public function trans()
    {
        return $this->hasOne('App\Models\trans');
    }

    public function trans2()
    {
        return $this->hasOne('App\Models\trans2');
    }

    public function trans3()
    {
        return $this->hasOne('App\Models\trans3');
    }
}
