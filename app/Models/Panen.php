<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $table = 'proses_buah';
    public $timestamps = false;
    protected $primaryKey = 'id_pb';
    protected $fillable = [
        'idPersilangan',
        'idAuth',
        'tanggal_pengerjaan',
        'status',
        'keterangan',
        'tanggal_input'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'idAuth');
    }

    public function persilangan()
    {
        return $this->belongsTo('App\Models\persilangan', 'idPersilangan');
    }
}
