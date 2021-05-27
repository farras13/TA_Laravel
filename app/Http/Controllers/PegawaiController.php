<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('Pegawai/Pegawai', compact('data'));
    }

    public function form()
    {
        return view('Pegawai/FormPegawai');
    }

    public function edit($id)
    {
        $val = User::find($id);
        return view('Pegawai/EditForm', compact('val'));
    }

    public function add (Request $request)
    {
        $user = new User();
        $user->name = ucwords(strtolower($request->name));
        $user->username = strtolower($request->username);
        $user->password = Hash::make($request->password);
        $user->lahir = $request->lahir;
        $user->jk = strtolower($request->jk);
        $user->alamat = $request->alamat;
        $user->hp = strtolower($request->hp);
        $user->role = strtolower($request->role);

        if ($image = $request->file('foto')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $user->foto = $profileImage;
        }

        $simpan = $user->save();


        if ($simpan) {
            return redirect()->route('pegawai')
            ->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('formpegawai')
            ->with('errors', 'Data Gagal Ditambahkan');
        }
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

        User::find($id)->update($data);
        return redirect()->route('pegawai')
                        ->with('success','Data Pegawai updated successfully');
    }

    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        User::find($id)->delete();
        return redirect()->route('pegawai')
            ->with('success', 'Data Berhasil Dihapus');
    }

    public function akun()
    {
        $data = User::all();
        return view('Pegawai.akun', compact('data'));
    }

    public function editAkun($id)
    {
        $data = User::find($id);
        return view('Pegawai.editAkun',compact('data'));
    }

    public function updateAkun(Request $request, $id)
    {
        $request->validate([
            'username'                  => 'required',
            'password'                    => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        User::find($id)->update($data);
        return redirect()->route('akun')
                        ->with('success','Product updated successfully');
    }
}
