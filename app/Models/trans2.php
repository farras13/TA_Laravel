<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trans2 extends Model
{
    protected $table = 'proses_trans2';
    public $timestamps = true;
    protected $primaryKey = 'id_pt2';
    protected $fillable = [
        'id_persilangan',
        'idAuth',
        'jumlah_botol',
        'qty',
        'status',
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
