<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Gen;
use App\Models\Jabatan;
use App\Models\pegawai;
use App\Models\Penggajian;
use App\Models\Tunjangan;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class PenggajianController extends Controller
{

    public function index()
    {
        $data = Penggajian::all();
        return view('penggajian.penggajian', compact('data'));
    }

    public function create()
    {
        $data = pegawai::all();
        $tunjangan = Tunjangan::all();

        return view('penggajian.tambah', compact('data', 'tunjangan'));
    }
    public function getData($id)
    {
        $a = pegawai::find($id);
        // print_r($a->jabatan);
        $empData['data'] = Jabatan::select('*')
            ->where('id_jabatan', $a->jabatan)
            ->get();

        return response()->json($empData);
    }

    public function countAbsen($id)
    {
        $empData['data'] = Absensi::select('idPegawai', 'created_at')
            ->where('idPegawai', '=', $id)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get();
        // $empData['data'] = array('c' => $emp->count(), );
        return response()->json($empData);
    }

    public function add(Request $request)
    {
        $a = Tunjangan::find($request->tj);

        $total = $a->nominal + ($request->gp * $request->ta) - $request->ut;
        Penggajian::create([
            'id_pegawai' => $request->idp,
            'gaji_pokok' => $request->gp,
            'kehadiran' => $request->ta,
            'tunjangan' => $request->tj,
            'hutang' => $request->ut,
            'total' => $total,
        ]);

        return redirect()->route('penggajian')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = Penggajian::find($id)->first();
        $user = pegawai::all();
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
        $data = Penggajian::find($id);
        return view('penggajian.print', compact('data'));
    }
}
