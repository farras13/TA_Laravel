<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('Pegawai');
    }
    public function form()
    {
        return view('FormPegawai');
    }
}
