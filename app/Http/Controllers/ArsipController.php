<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Anggota;
use App\Models\Periode;
use App\Models\Proker;

class ArsipController extends Controller
{
    public function index()
    {
        $divisi = Divisi::with('periode')->orderBy('id_periode', 'desc')->get();
        $jabatan = Jabatan::with('periode')->orderBy('id_periode', 'desc')->get();
        $anggota = Anggota::with(['divisi', 'jabatan', 'periode'])->orderBy('id_periode', 'desc')->get();
        $periode = Periode::orderBy('id_periode', 'desc')->get();
        $proker = Proker::with(['periode', 'divisi'])->orderBy('id_periode', 'desc')->get();

        return view('arsip', compact('divisi', 'jabatan', 'anggota', 'periode', 'proker'));
    }
}
