<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    protected $table = 'penggajian';
    public $timestamps = false;
    protected $primaryKey = 'id_gaji';
    protected $fillable = [
        'id_pegawai',
        'gaji_pokok',
        'tunjangan',
        'bonus',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'id_pegawai');
    }

}
