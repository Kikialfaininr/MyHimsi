<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Anggota;
use App\Models\Periode;

class WelcomeController extends Controller
{
    public function index()
    {
        $periode = Periode::where('keterangan', 'Aktif')->first();

        $divisi = $periode ? Divisi::where('id_periode', $periode->id_periode)->get() : collect();
        $jabatan = $periode ? Jabatan::where('id_periode', $periode->id_periode)->get() : collect();
        $anggota = $periode ? Anggota::with(['divisi', 'jabatan', 'periode'])
                                ->where('id_periode', $periode->id_periode)
                                ->get() : collect();

        return view('welcome', compact('divisi', 'jabatan', 'anggota', 'periode'));
    }
}
