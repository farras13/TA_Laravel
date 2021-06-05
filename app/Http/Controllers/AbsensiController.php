<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\pegawai;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = Absensi::all();
        return view('absensi.index', compact('data'));
    }
    public function create()
    {
        $data = pegawai::select('id_pegawai', 'name')->get();
        return view('absensi.tambah', compact('data'));
    }
    public function add(Request $request)
    {
        $request->validate(['idp' => 'required']);
        Absensi::create([
            'idPegawai' => $request->idp,
            'keterangan' => $request->ket,
        ]);
         //jika data berhasil ditambahkan, akan kembali ke halaman utama
         return redirect()->route('absensi')
             ->with('success', 'Data Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $p = Absensi::find($id)->first();
        $data = pegawai::select('id_pegawai', 'name')->get();
        return view('absensi.edit', compact('data', 'p'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(['idp' => 'required']);
        Absensi::find($id)->update(['idPegawai' => $request->idp ]);
         //jika data berhasil ditambahkan, akan kembali ke halaman utama
         return redirect()->route('absensi')
             ->with('success', 'Data Berhasil Di edit');
    }
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        Absensi::find($id)->delete();
        return redirect()->route('absensi')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
