<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trans3 extends Model
{
    protected $table = 'proses_trans3';
    public $timestamps = false;
    protected $primaryKey = 'id_pt3';
    protected $fillable = [
        'id_persilangan',
        'idAuth',
        'tanggal_pengerjaan',
        'status',
        'target',
        'botolT2',
        'stok',
        'kontam',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'idAuth');
    }

    public function persilangan()
    {
        return $this->belongsTo('App\Models\persilangan', 'id_persilangan');
    }
}
