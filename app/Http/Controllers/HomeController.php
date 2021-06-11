<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Persilangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $proses = $this->countPersilangan(0);
        $berhasil = $this->countPersilangan(1);
        $gagal = $this->countPersilangan(2);
        $absen = $this->countAbsen();
        return view('dashboard', compact('proses','berhasil','gagal', 'absen'));
    }

    public function countPersilangan($id)
    {
        if ($id == 0) {
            $a = Persilangan::select('kodePersilangan')
            ->where('status_trans3', '=', 0)
            ->get();
            return $a;
        }elseif ($id == 1) {
            $a = Persilangan::select('kodePersilangan')
            ->where('status_trans3', '=', 1)
            ->orWhere('status_trans3', '=', 3)
            ->get();
            return $a;
        }else{
            $a = Persilangan::select('kodePersilangan')
            ->where('status_trans3', '=', 2)
            ->get();
            return $a;
        }

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
