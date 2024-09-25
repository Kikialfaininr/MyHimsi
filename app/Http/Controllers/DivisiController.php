<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Anggota;
use App\Models\Proker;
use App\Models\Periode;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index($id)
    {
        $periode = Periode::where('keterangan', 'Aktif')->first();
        $divisi = Divisi::with(['periode'])->findOrFail($id);
        $anggota = Anggota::where('id_divisi', $id)->with('jabatan')->get();
        $proker = Proker::where('id_divisi', $id)->get();

        return view('divisi', compact('divisi', 'anggota', 'proker', 'periode'));
    }

}
