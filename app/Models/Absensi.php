<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    public $timestamps = true;
    protected $primaryKey = 'idAbsen';
    protected $fillable = [
        'idPegawai',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\pegawai', 'idPegawai');
    }

}
