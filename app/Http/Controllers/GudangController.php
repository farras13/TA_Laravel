<?php

namespace App\Http\Controllers;

use App\Models\Eksternal;
use App\Models\Gen;
use App\Models\Persilangan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    public function index()
    {
        $data = Tanaman::all();
        return view('internal.index', compact('data'));
    }

    public function create()
    {
        $gen = Gen::all();
        return view('internal.tambah', compact('gen'));
    }

    public function add(Request $request)
    {
        Tanaman::create([
            'idTanaman' => $request->kode,
            'idGen' => $request->gen,
            'jk' => $request->jk,
            'name' => $request->nama,
            'stok' => $request->stok,
            'status' => "internal",
            'show_status' => 0,
        ]);

        return redirect()->route('gudang')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = Tanaman::find($id);
        $gen = Gen::all();
        return view('internal.edit', compact('data', 'gen'));
    }

    public function detail($id)
    {
        $data = Tanaman::find($id);
        $dt = ['nama' => $data->name, 'jk' => $data->jk ];
        $dtt = ['calon_nama' => $data->name, 'calon_jk' => $data->jk ];
        $cek = eksternal::where($dt)->first();
        $persilangan = Persilangan::where($dtt)->get();
        // print_r($cek);die;
        return view('internal.detail', compact('data', 'cek', 'persilangan'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $data = [
            'idGen' => $request->gen,
            'jk' => $request->jk,
            'name' => $request->nama,
            'stok' => $request->stok,
            'status' => $request->status,
        ];
        Tanaman::find($id)->update($data);

        return redirect()->route('gudang')
            ->with('success', 'Data Berhasil Di edit');
    }

    public function destroy($id)
    {
        Tanaman::find($id)->delete();
        return redirect()->route('proses')
            ->with('success', 'Data Berhasil di Hapus');
    }

    public function eksin()
    {
        $data = Eksternal::all();
        return view('eksternal.in.index', compact('data'));
    }
    public function create2()
    {
        $gen = Gen::all();
        return view('eksternal.in.tambah', compact('gen'));
    }
    public function add2(Request $request)
    {

        $tgl = $request->tgl . ' ' . $request->tm;
        $dt = ['name' => $request->nama, 'jk' => $request->jk ];
        $cek = Tanaman::where($dt)->first();
        // $cek = Tanaman::where(['name','=',$request->nama], ['jk','=',$request->jk])->first();

        if (!empty($cek)) {
            $jml = $cek->stok + $request->jb;
            $edit = ['stok' => $jml];
            Tanaman::find($cek->idTanaman)->update($edit);
        }else{
            $ck = Tanaman::select('*')->orderByDesc("idTanaman")->first();
            $kd = $ck->idTanaman + 1;
            Tanaman::create([
                'idTanaman' => $kd,
                'idGen' => $request->gen,
                'jk' => $request->jk,
                'name' => $request->nama,
                'stok' => $request->jb,
                'status' => 'eksternal',
            ]);
        }

        eksternal::create([
            'tanggal_masuk' => $tgl,
            'asju' => $request->asal,
            'status' => 'Masuk',
            'nama' => $request->nama,
            'jk' => $request->jk,
            'gen' => $request->gen,
            'jumlah' => $request->jb,
            'keterangan' => $request->ket,
            'author' => Auth::user()->id,
        ]);

        return redirect()->route('eksin')
            ->with('success', 'Data Berhasil Ditambahkan');
    }
    public function edit2($id)
    {
        $data = eksternal::find($id);
        $gen = Gen::all();
        return view('eksternal.in.edit', compact('data','gen'));
    }
    public function update2(Request $request, $id)
    {
        $tgl = $request->tgl . ' ' . $request->tm;
        $ck = eksternal::find($id);

        $dt = ['name' => $ck->nama, 'jk' => $ck->jk ];
        $cek = Tanaman::where($dt)->first();

        if (!empty($cek)) {
            if($ck->jumlah > $request->jb){
                $jm = $ck->jumlah - $request->jb;
                $jml = $cek->stok - $jm;
            }else if($ck->jumlah < $request->jb){
                $jm = $request->jb - $cek->stok;
                $jml = $cek->stok + $jm;
            }else{
                $jml = $request->jb;
            }
            // print_r($jml);die;
            $edit = [
                'idGen' => $request->gen,
                'jk' => $request->jk,
                'name' => $request->nama,
                'stok' => $jml
            ];
            Tanaman::find($cek->idTanaman)->update($edit);
        }
        // print_r($cek); die;


        $data = [
            'tanggal_masuk' => $tgl,
            'asju' => $request->asal,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'gen' => $request->gen,
            'jumlah' => $request->jb,
            'keterangan' => $request->ket,
        ];
        eksternal::find($id)->update($data);

        return redirect()->route('eksin')
            ->with('success', 'Data Berhasil Di edit');
    }
    public function destroy2($id)
    {
        eksternal::find($id)->delete();
        return redirect()->route('eksin')
            ->with('success', 'Data Berhasil di Hapus');
    }

    public function eksout()
    {
        $data = eksternal::all();
        return view('eksternal.out.index', compact('data'));
    }
    public function create3()
    {
        $data = Tanaman::all();
        return view('eksternal.out.tambah', compact('data'));
    }
    public function getData($id=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = Tanaman::orderby("name","asc")
        			->select('*')
        			->where('idTanaman',$id)
        			->get();

        return response()->json($empData);

    }
    public function add3(Request $request)
    {
        $dt = Tanaman::find($request->idt);
        $tgl = $request->tgl . ' ' . $request->tm;
        $jml = $dt->stok - $request->jb;

        $a = eksternal::create([
            'tanggal_keluar' => $tgl,
            'asju' => $request->asal,
            'status' => 'Keluar',
            'nama' => $request->nama,
            'jk' => $request->jk,
            'gen' => $request->gen,
            'jumlah' => $request->jb,
            'keterangan' => $request->ket,
            'author' => Auth::user()->id,
        ]);

        $edit = ['stok' => $jml, ];
        Tanaman::find($request->idta)->update($edit);

        return redirect()->route('eksout')
            ->with('success', 'Data Berhasil Ditambahkan');
    }
    public function edit3($id)
    {
        $data = eksternal::find($id);
        $gen = Gen::all();
        return view('eksternal.out.edit', compact('data', 'gen'));
    }
    public function update3(Request $request, $id)
    {
        $cek = ['name' => $request->nama, 'jk' => $request->jk ];
        $dt = Tanaman::where($cek)->first();
        $data = eksternal::find($id);

        $tgl = $request->tgl . ' ' . $request->tm;

        if ($data->jumlah > $request->jb) {
           $s = $data->jumlah - $request->jb;
           $jml = $dt->stok + $s;
        }elseif($data->jumlah < $request->jb){
            $s = $request->jb - $data->jumlah;
            $jml = $dt->stok - $s;
        }

        $edit = ['stok' => $jml, ];
        Tanaman::where($cek)->update($edit);

        $data = [
            'tanggal_keluar' => $tgl,
            'asju' => $request->asal,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'gen' => $request->gen,
            'jumlah' => $request->jb,
            'keterangan' => $request->ket,
        ];
        eksternal::find($id)->update($data);

        return redirect()->route('eksout')
            ->with('success', 'Data Berhasil Di edit');
    }
    public function destroy3($id)
    {
        eksternal::find($id)->delete();
        return redirect()->route('eksout')
            ->with('success', 'Data Berhasil di Hapus');
    }
}
