<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = pegawai::all();
        return view('Pegawai/Pegawai', compact('data'));
    }

    public function form()
    {
        return view('Pegawai/FormPegawai');
    }

    public function edit($id)
    {
        $val = pegawai::find($id);
        return view('Pegawai/EditForm', compact('val'));
    }

    public function add (Request $request)
    {
        if ($image = $request->file('foto')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

        pegawai::create([
            'name' => ucwords(strtolower($request->name)),
            'lahir' => $request->lahir,
            'jk' => strtolower($request->jk),
            'alamat' => $request->alamat,
            'hp' =>  strtolower($request->hp),
            'role' => strtolower($request->role),
            'foto' => $profileImage,
        ]);

        return redirect()->route('pegawai')
        ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                  => 'required',
            'hp'                    => 'required',
            'lahir'                 => 'required',
            'jk'                    => 'required',
            'alamat'                => 'required',
            'foto'                  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('foto')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data = [
                'name' => $request->name,
                'lahir' => $request->lahir,
                'jk' => $request->jk,
                'hp' => $request->hp,
                'alamat' => $request->alamat,
                'foto' =>  $profileImage,
            ];
        }else{
            $data = [
                'name' => $request->name,
                'lahir' => $request->lahir,
                'jk' => $request->jk,
                'hp' => $request->hp,
                'alamat' => $request->alamat
            ];
        }

        pegawai::find($id)->update($data);
        return redirect()->route('pegawai')
                        ->with('success','Data Pegawai updated successfully');
    }

    public function destroy($id)
    {
        $del = array('id_pegawai' => $id, );
        $data = array('aktif' => 1, );
        $a = pegawai::find($id)->delete();
        // print_r($a);die;
        // User::where($del)->update($data);
        return redirect()->route('pegawai')
            ->with('success', 'Data Berhasil Dihapus');
    }

    public function akun()
    {
        $data = User::all();
        return view('Pegawai.akun', compact('data'));
    }
    public function formAkun()
    {
        $data = pegawai::all();
        return view('Pegawai/register', compact('data'));
    }
    public function editAkun($id)
    {
        $user = pegawai::all();
        $data = User::find($id);
        return view('Pegawai.editAkun',compact('data', 'user'));
    }

    public function addAkun(Request $request)
    {
        $user = new User();
        $user->username = strtolower($request->username);
        $user->password = Hash::make($request->password);
        $user->id_pegawai = $request->idp;

        $simpan = $user->save();

        if ($simpan) {
            return redirect()->route('pegawai')
            ->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('formpegawai')
            ->with('errors', 'Data Gagal Ditambahkan');
        }
    }

    public function updateAkun(Request $request, $id)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_pegawai' => $request->idp

        ];
        User::find($id)->update($data);
        return redirect()->route('akun')
                ->with('success','Product updated successfully');
    }

    public function jabatan()
    {
        $data = Jabatan::all();
        return view('jabatan/index', compact('data'));
    }

    public function createJ()
    {
        return view('jabatan/tambah');
    }

    public function editJ($id)
    {
        $p = Jabatan::find($id);
        return view('jabatan/edit', compact('p'));
    }

    public function addJ (Request $request)
    {
        pegawai::create([
            'jabatan' => ucwords(strtolower($request->nj)),
            'gaji_pokok' => $request->gp,
        ]);

        return redirect()->route('jabatan')
        ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function updateJ(Request $request, $id)
    {
        $data = [
            'jabatan' => ucwords(strtolower($request->nj)),
            'gaji_pokok' => $request->gp,
        ];

        Jabatan::find($id)->update($data);
        return redirect()->route('jabatan')
                        ->with('success','Data updated successfully');
    }

    public function destroyJ($id)
    {
        Jabatan::find($id)->delete();
        return redirect()->route('jabatan')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
