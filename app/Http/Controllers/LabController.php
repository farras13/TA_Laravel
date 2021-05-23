<?php

namespace App\Http\Controllers;

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
}
