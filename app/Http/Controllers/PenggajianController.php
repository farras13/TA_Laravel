<?php

namespace App\Http\Controllers;

use App\Models\Gen;
use App\Models\Penggajian;
use App\Models\User;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{

    public function index()
    {
        $data = Penggajian::all();
        return view('penggajian.penggajian', compact('data'));
    }

    public function create()
    {
        $data = User::all();
        return view('penggajian.tambah', compact('data'));
    }

    public function add(Request $request)
    {
        Penggajian::create([
            'id_pegawai' => $request->idp,
            'gaji_pokok' => $request->gp,
            'tunjangan' => $request->tj,
            'bonus' => $request->bns,
        ]);

        return redirect()->route('penggajian')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = Penggajian::find($id)->first();
        $user = User::all();
        return view('penggajian.edit', compact('data', 'user'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'id_pegawai' => $request->idp,
            'gaji_pokok' => $request->gp,
            'tunjangan' => $request->tj,
            'bonus' => $request->bns,
        ];

        Penggajian::find($id)->update($data);

        return redirect()->route('penggajian')
            ->with('success', 'Data Berhasil Di edit');
    }

    public function destroy($id)
    {
        Penggajian::find($id)->delete();
        return redirect()->route('penggajian')
            ->with('success', 'Data Berhasil Dihapus');
    }

    public function print($id)
    {
        $data = Penggajian::find($id)->first();
        return view('penggajian.print', compact('data'));
    }

}


