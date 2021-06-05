<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    protected $table = 'tunjangan';
    public $timestamps = false;
    protected $primaryKey = 'idTunjangan';
    protected $fillable = [
        'tunjangan',
        'nominal',
    ];

    public function penggajian()
    {
        return $this->hasOne('App\Models\penggajian');
    }
}
