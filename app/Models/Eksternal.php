<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eksternal extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_masuk',
        'asju',
        'tanggal_keluar',
        'status',
        'nama',
        'gen',
        'jk',
        'jumlah',
        'keterangan',
        'show_status',
        'author'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'author');
    }

    public function gen()
    {
        return $this->belongsTo('App\Models\Gen', 'gen');
    }
}
