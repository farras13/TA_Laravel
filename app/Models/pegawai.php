<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawai';
    public $timestamps = true;
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'name',
        'lahir',
        'jk',
        'alamat',
        'hp',
        'role',
        'foto',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function absen()
    {
        return $this->hasOne('App\Models\Absensi');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Model\jabatan');
    }
}
