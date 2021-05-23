<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trans extends Model
{
    protected $table = 'proses_trans';
    public $timestamps = false;
    protected $primaryKey = 'id_pt';
    protected $fillable = [
        'idPersilangan',
        'idAuth',
        'kontam',
        'qty',
        'jumlah_botol',
        'tgl_pengerjaan',
        'status',
        'keterangan'
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
