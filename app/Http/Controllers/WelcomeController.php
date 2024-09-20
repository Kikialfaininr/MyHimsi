<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Anggota;

class WelcomeController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $anggota = Anggota::with(['divisi', 'jabatan'])->get();

        return view('welcome', compact('divisi', 'jabatan', 'anggota'));
    }
}
