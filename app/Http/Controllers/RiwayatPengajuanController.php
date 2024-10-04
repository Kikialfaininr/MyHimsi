<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Artikel;
use App\Models\Haki;
use App\Models\TugasAkhir;

class RiwayatPengajuanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $artikel = Artikel::where('id', $userId)
                          ->orderBy('tahun_terbit', 'DESC')
                          ->get();
        
        $haki = Haki::where('id', $userId)
                     ->orderBy('tanggal_terbit', 'DESC')
                     ->get();
        
        $tugasakhir = TugasAkhir::where('id', $userId)
                                 ->orderBy('created_at', 'DESC')
                                 ->get();

        return view('riwayat-pengajuan', compact('artikel', 'haki', 'tugasakhir'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $artikel = Artikel::where('id_artikel', $id)->first();
            $artikel->judul = $request->judul;
            $artikel->nama_mahasiswa = $request->nama_mahasiswa;
            $artikel->penerbit = $request->penerbit;
            $artikel->tahun_terbit = $request->tahun_terbit;
            $artikel->link_artikel = $request->link_artikel;
            $artikel->id = Auth::id();
        $artikel->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function updateHaki(Request $request, $id)
    {
        $haki = Haki::where('id_haki', $id)->first();
            $haki->nomor = $request->nomor;
            $haki->tanggal_terbit = $request->tanggal_terbit;
            $haki->judul = $request->judul;
            $haki->nama_mahasiswa = $request->nama_mahasiswa;
            $haki->bentuk = $request->bentuk;
            $haki->id = Auth::id();
        $haki->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function updateTugasakhir(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::where('id_ta', $id)->first();
            $tugasakhir->judul = $request->judul;
            $tugasakhir->nama_mahasiswa = $request->nama_mahasiswa;
            $tugasakhir->bentuk = $request->bentuk;
            $tugasakhir->id = Auth::id();
        $tugasakhir->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function hapusArtikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $artikel->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }

    public function hapusHaki(Request $request, $id)
    {
        $haki = Haki::findOrFail($id);

        $haki->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }

    public function hapusTugasakhir(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::findOrFail($id);

        $tugasakhir->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }
}
