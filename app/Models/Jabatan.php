<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    public $timestamps = false;
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        'jabatan',
        'gaji_pokok',
        'status',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->hasOne('App\Models\pegawai', 'id_jabatan');
    }
}
