<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Persilangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $persilangan = $this->countPersilangan();
        $absen = $this->countAbsen();
        return view('dashboard', compact('persilangan', 'absen'));
    }

    public function countPersilangan()
    {
        $a = Persilangan::select('kodePersilangan')
                ->where('status_trans3', '=', 1)
                ->orWhere('status_trans3', '=', 3)
                ->get();
        return $a;
    }

    public function countAbsen()
    {
        $a = Absensi::select('idPegawai')
                ->whereDate('created_at', date('Y-m-d'))
                ->get();
        return $a;
    }

    public function countKebun()
    {
        # code...
    }

}
