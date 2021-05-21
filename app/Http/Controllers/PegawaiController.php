<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('Pegawai/Pegawai');
    }
    public function form()
    {
        return view('Pegawai/FormPegawai');
    }
}
