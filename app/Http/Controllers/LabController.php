<?php

namespace App\Http\Controllers;

use App\Models\Gen;
use App\Models\Persilangan;
use App\Models\Tanaman;
use App\Models\trans;
use App\Models\trans2;
use App\Models\trans3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    // trans 1
    public function index()
    {
        $data = trans::all();
        return view('lab.1.index', compact('data'));
    }

    public function create()
    {
        $silang = Persilangan::all();
        return view('lab.1.tambah', compact('silang'));
    }

    public function add(Request $request)
    {
        trans::create([
            'idPersilangan' => $request->persilangan,
            'status' => $request->status,
            'jumlah_botol' => $request->jb,
            'keterangan' => $request->ket,
            'idAuth' => Auth::user()->id
        ]);

        $edit = ['status_trans' => $request->status];

        $id = $request->persilangan;
        Persilangan::find($id)->update($edit);

        return redirect()->route('trans')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = trans::find($id);
        return view('lab.1.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $core =  trans::find($id);

        $request->validate([
            'status' => 'required'
        ]);

        $data = [
            'status' => $request->status,
            'jumlah_botol' => $request->jb,
            'kontam' => $request->ktm,
            'qty' => $request->qty,
            'keterangan' => $request->ket
        ];

        trans::find($id)->update($data);

        $edit = ['status_trans' => $request->status];

        Persilangan::find($core['idPersilangan'])->update($edit);

        return redirect()->route('trans')
            ->with('success', 'Data Berhasil Di edit');
    }

    public function destroy($id)
    {
        $core =  trans::find($id)->first();
        trans::find($id)->delete();
        $edit = ['status_trans' => 0, 'status_trans2' => 0, 'status_trans3' => 0,];
        Persilangan::find($core->idPersilangan)->update($edit);
        return redirect()->route('trans')
            ->with('success', 'Data Berhasil Dihapus');
    }

    // trans 2

    public function trans2()
    {
        $data = trans2::all();
        return view('lab.2.index', compact('data'));
    }
    public function create2()
    {
        $silang = Persilangan::all();
        $trans = trans::orderBy('idPersilangan', 'desc')->get();
        $gen = Gen::all();
        return view('lab.2.tambah', compact('silang', 'gen', 'trans'));
    }
    public function getDataT($id=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = Trans::select('qty')
        			->where('idPersilangan',$id)
        			->get();

        return response()->json($empData);

    }
    public function getDataTa($id=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = Tanaman::select('name')
        			->where('name',$id)
        			->get();

        return response()->json($empData);

    }
    public function add2(Request $request)
    {
        $request->validate([
            'persilangan' => 'required',
            'status' => 'required|min:1',
        ]);

        trans2::create([
            'id_persilangan' => $request->persilangan,
            'status' => $request->status,
            'jumlah_botol' => $request->jb,
            'keterangan' => $request->ket,
            'idAuth' => Auth::user()->id,
        ]);

        $dt = ['name' => $request->nt, 'jk' => $request->jk ];
        $cek = Tanaman::where($dt)->first();
        // $cek = Tanaman::where(['name','=',$request->nama], ['jk','=',$request->jk])->first();

        if (!empty($cek)) {
            $edit = [
                'status_trans2' => $request->status,
                'calon_kode' => $cek->idTanaman,
                'calon_nama' => $request->nt,
                'calon_gen' => $request->gt,
                'calon_jk' => $request->jk,
            ];

            $id = $request->persilangan;
            Persilangan::find($id)->update($edit);
        }else{
            $ck = Tanaman::select('*')->orderByDesc("idTanaman")->first();
            $kd = $ck->idTanaman + 1;

            $edit = [
                'status_trans2' => $request->status,
                'calon_kode' => $kd,
                'calon_nama' => $request->nt,
                'calon_gen' => $request->gt,
                'calon_jk' => $request->jk,
            ];

            $id = $request->persilangan;
            Persilangan::find($id)->update($edit);

            Tanaman::create([
                'idTanaman' => $kd,
                'idGen' => $request->gt,
                'jk' => $request->jk,
                'name' => $request->nt,
                'stok' => $request->jb,
                'status' => 'internal',
            ]);
        }

        return redirect()->route('trans2')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit2($id)
    {
        $gen = Gen::all();
        $data = trans2::find($id);
        return view('lab.2.edit', compact('data', 'gen'));
    }

    public function update2(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $cek = Persilangan::select('calon_nama,calon_kode,calon_gen,calon_jk')->where('calon_nama',$request->nt)->first();
        $core =  trans2::find($id);

        if ($request->status == 2) {
            $idd = $core->persilangan->calon_kode;
            Tanaman::find($idd)->delete();

            $cln = [
                'status_trans2' => $request->status,
                'calon_kode' => null,
                'calon_nama' => null,
                'calon_gen' => null,
                'calon_jk' => null,
            ];
            Persilangan::find($core->id_persilangan)->update($cln);
        }else{
            $dt = ['name' => $request->nt, 'jk' => $request->jk ];
            $cekk = Tanaman::where($dt)->first();
            // $cek = Tanaman::where(['name','=',$request->nama], ['jk','=',$request->jk])->first();

            if (!empty($cekk)) {
                $edit = [
                    'status_trans2' => $request->status,
                    'calon_kode' => $cekk->idTanaman,
                    'calon_nama' => $request->nt,
                    'calon_gen' => $request->gt,
                    'calon_jk' => $request->jk,
                ];

                $id = $request->persilangan;
                Persilangan::find($id)->update($edit);
            }else{
                $ck = Tanaman::select('*')->orderByDesc("idTanaman")->first();
                $kd = $ck->idTanaman + 1;

                $edit = [
                    'status_trans2' => $request->status,
                    'calon_kode' => $kd,
                    'calon_nama' => $request->nt,
                    'calon_gen' => $request->gt,
                    'calon_jk' => $request->jk,
                ];

                $id = $request->persilangan;
                Persilangan::find($id)->update($edit);

                Tanaman::create([
                    'idTanaman' => $kd,
                    'idGen' => $request->gt,
                    'jk' => $request->jk,
                    'name' => $request->nt,
                    'stok' => $request->jb,
                    'status' => 'internal',
                ]);
            }
        }


        $data = [
            'status' => $request->status,
            'jumlah_botol' => $request->jb,
            'keterangan' => $request->ket
        ];

        trans2::find($id)->update($data);
        $edit = [
            'status_trans2' => $request->status,
            'calon_kode' => $request->kt,
            'calon_nama' => $request->nt,
            'calon_gen' => $request->gt,
            'calon_jk' => $request->jk,
        ];
        Persilangan::find($core->id_persilangan)->update($edit);

        return redirect()->route('trans2')
            ->with('success', 'Data Berhasil Di edit');
    }

    public function destroy2($id)
    {
        $core =  trans2::find($id);
        trans2::find($id)->delete();
        $edit = ['status_trans2' => 0, 'status_trans3' => 0,];
        Persilangan::find($core->id_persilangan)->update($edit);
        return redirect()->route('trans2')
            ->with('success', 'Data Berhasil Dihapus');
    }

    // trans 3
    public function trans3()
    {
       $data = trans3::all();
       return view('lab.3.index', compact('data'));
    }
    public function create3()
    {
        $silang = trans2::all();
        $trans = trans2::orderBy('id_persilangan', 'desc')->get();
        return view('lab.3.tambah', compact('silang', 'trans'));
    }

    public function getData($id=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = Trans2::select('*')
        			->where('id_persilangan',$id)
        			->get();

        return response()->json($empData);

    }

    public function add3(Request $request)
    {
        $request->validate([
            'persilangan' => 'required',
            'status' => 'required',
        ]);

        trans3::create([
            'id_persilangan' => $request->persilangan,
            'status' => $request->status,
            'target' => $request->target,
            'botolT2' => $request->jb,
            'stok' => $request->stok,
            'kontam' => $request->kontam,
            'keterangan' => $request->ket,
            'idAuth' => Auth::user()->id,
            'tgl_pengerjaan' => $request->tgl,
        ]);

        $st = ['qty' => $request->jb];
        trans2::where('id_persilangan',$request->persilangan)->update($st);

        $edit = ['status_trans3' => $request->status, ];
        $id = $request->persilangan;
        Persilangan::find($id)->update($edit);

        return redirect()->route('trans3')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit3($id)
    {
        $data = trans3::find($id);
        return view('lab.3.edit', compact('data'));
    }

    public function update3(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $data = [
            'status' => $request->status,
            'target' => $request->target,
            'botolT2' => $request->jb,
            'stok' => $request->stok,
            'kontam' => $request->kontam,
            'keterangan' => $request->ket
        ];

        trans3::find($id)->update($data);
        
        $x = trans2::where('id_persilangan', $request->persilangan)->first();
        $jml = $x->qty + $request->jb;
        $st = ['qty' => $jml];
        trans2::where('id_persilangan', $request->persilangan)->update($st);

        $edit = ['status_trans3' => $request->status, ];
        $core =  trans3::find($id);
        Persilangan::find($core->id_persilangan)->update($edit);

        return redirect()->route('trans3')
            ->with('success', 'Data Berhasil Di edit');
    }

    public function destroy3($id)
    {
        trans3::find($id)->delete();
        $core =  trans3::find($id);
        $edit = ['status_trans3' => 0,];
        Persilangan::find($core->id_persilangan)->update($edit);
        return redirect()->route('trans3')
            ->with('success', 'Data Berhasil Dihapus');
    }
}


