<?php

namespace App\Http\Controllers;

use App\Models\Persilangan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersilanganController extends Controller
{

    public function index()
    {
        $persilangan = Persilangan::all();
        $tanaman = Tanaman::all();
        return view('persilangan.index', compact('persilangan', 'tanaman'));
    }

    public function formT()
    {
        $tanaman = Tanaman::all();
        return view('persilangan.tambah', compact('tanaman'));
    }

    public function formE($id)
    {
        $val = Persilangan::find($id);
        $data = Tanaman::all();
        return view('persilangan.edit', compact('data', 'val'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'seed'          => 'required|string',
            'pollen'        => 'required|string'
        ]);

        $x = DB::table('persilangan')->orderBy('created_at','desc')->first();
	    $count = strlen($x->kodePersilangan);
    		if ($count < 5) {
    			$yes = substr("" . $x->kodePersilangan, 0, 1);
    		}else{
    			$yes = substr("" . $x->kodePersilangan, 0, 2);
    		}
		$now = date('m');
            // print_r($x);die;
		if ($now != $yes) {
			$a = 1;
			$kode = "" . date('m') . date('y') . $a;
		} else {
			$kd = substr("" . $x->kodePersilangan, 0, 5);
			$kode = $kd + 1;
		}

        Persilangan::create([
            'kodePersilangan' => $kode,
            'tanggal' => $request->tgl,
            'seed' => $request->seed,
            'pollen' => $request->pollen,
            'idAuth' => Auth::user()->id
        ]);
         //jika data berhasil ditambahkan, akan kembali ke halaman utama
         return redirect()->route('persilangan')
             ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function rubah(Request $request, $id)
    {
        //melakukan validasi data
        $request->validate([
            'seed' => 'required',
            'pollen' => 'required'
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        Persilangan::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('persilangan')
            ->with('success', 'Data Berhasil Diupdate');
    }

    public function hapus($id)
    {
        //fungsi eloquent untuk menghapus data
        Persilangan::find($id)->delete();
        return redirect()->route('persilangan')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
