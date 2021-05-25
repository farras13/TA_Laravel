<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    protected $table = 'tanaman';
    public $timestamps = false;
    protected $primaryKey = 'idTanaman';
    protected $fillable = [
        'idTanaman',
        'idGen',
        'jk',
        'name',
        'stok',
        'status',
        'show_status',
    ];

    public function gen()
    {
        return $this->belongsTo('App\Models\Gen', 'idGen');
    }

    public function persilangan()
    {
        return $this->hasOne('App\Models\persilangan');
    }
}
