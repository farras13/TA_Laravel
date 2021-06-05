<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    protected $table = 'penggajian';
    public $timestamps = true;
    protected $primaryKey = 'id_gaji';
    protected $fillable = [
        'id_pegawai',
        'gaji_pokok',
        'tunjangan',
        'hutang',
        'total',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\pegawai', 'id_pegawai');
    }

    public function tj()
    {
        return $this->belongsTo('App\Models\tunjangan', 'tunjangan');
    }

}
