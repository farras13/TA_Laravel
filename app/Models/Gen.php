<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gen extends Model
{
    protected $table = 'gen';
    public $timestamps = false;
    protected $primaryKey = 'idGen';
    protected $fillable = [
        'gen',
    ];

    public function tanaman()
    {
        return $this->hasOne('App\Models\Tanaman');
    }

    public function eksternal()
    {
        return $this->hasOne('App\Models\Eksternal');
    }
}
