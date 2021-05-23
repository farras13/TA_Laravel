<?php

namespace App\Http\Controllers;

use App\Models\Gen;
use App\Models\Persilangan;
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
        $request->validate([
            'persilangan' => 'required',
            'status' => 'required',
        ]);

        trans::create([
            'idPersilangan' => $request->persilangan,
            'status' => $request->status,
            'jumlah_botol' => $request->jb,
            'keterangan' => $request->ket,
            'idAuth' => Auth::user()->id,
            'tgl_pengerjaan' => $request->tgl,
        ]);

        if ($request->status == 2) {
            $edit = ['status_trans' => $request->status,'status_trans2' => $request->status];
        }else{
            $edit = ['status_trans' => $request->status];
        }
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

        if ($request->status == 2) {
            $edit = ['status_trans' => $request->status,'status_trans2' => $request->status];
        }else{
            $edit = ['status_trans' => $request->status];
        }

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
        $empData['data'] = Trans::select('*')
        			->where('idPersilangan',$id)
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
            'tgl_pengerjaan' => $request->tgl,
        ]);

        $edit = [
            'status_trans2' => $request->status,
            'calon_kode' => $request->kt,
            'calon_nama' => $request->nt,
            'calon_gen' => $request->gt,
            'calon_jk' => $request->jk,
        ];
        $id = $request->persilangan;
        Persilangan::find($id)->update($edit);

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
        $core =  trans2::find($id);
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
}


