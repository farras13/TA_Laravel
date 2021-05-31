<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    protected $table = 'proses_kawin';
    public $timestamps = true;
    protected $primaryKey = 'id_pk';
    protected $fillable = [
        'idPersilangan',
        'status',
        'keterangan',
        'idAuth',
        'tanggal'
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
