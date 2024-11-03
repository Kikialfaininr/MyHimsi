<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Haki;
use App\Models\TugasAkhir;

class PrestasiController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'Diterima')->orderBy('tahun_terbit', 'DESC')->get();
        $haki = Haki::where('status', 'Diterima')->orderBy('tanggal_terbit', 'DESC')->get();
        $tugasakhir = TugasAkhir::where('status', 'Diterima')->orderBy('created_at', 'DESC')->get();

        return view('prestasi', compact('artikel', 'haki', 'tugasakhir'));
    }

    public function simpanArtikel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'unique:artikel',
        ], [
            'judul.unique' => 'Gagal menyimpan data karna judul artikel sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/prestasi')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->nama_mahasiswa = $request->nama_mahasiswa;
        $artikel->penerbit = $request->penerbit;
        $artikel->tahun_terbit = $request->tahun_terbit;
        $artikel->link_artikel = $request->link_artikel;
        
        // Mengisi ID pengguna yang sedang autentikasi
        $artikel->id = Auth::id();

        $artikel->save();

        return redirect('/riwayat-pengajuan')
            ->with('message', 'Data artikel berhasil diajukan, sialahkan tunggu pembaharuan statusnya!')
            ->with('alert_class', 'success');      
    }

    public function simpanHaki(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'unique:haki',
        ], [
            'nomor.unique' => 'Gagal menyimpan data karna nomor HaKI sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/prestasi')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $haki = new Haki();
        $haki->nomor = $request->nomor;
        $haki->tanggal_terbit = $request->tanggal_terbit;
        $haki->judul = $request->judul;
        $haki->nama_mahasiswa = $request->nama_mahasiswa;
        $haki->bentuk = $request->bentuk;
        
        // Mengisi ID pengguna yang sedang autentikasi
        $haki->id = Auth::id();

        $haki->save();

        return redirect('/riwayat-pengajuan')
            ->with('message', 'Data HaKI berhasil diajukan, sialahkan tunggu pembaharuan statusnya!')
            ->with('alert_class', 'success');      
    }

    public function simpanTugasakhir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'unique:tugasakhir',
        ], [
            'judul.unique' => 'Gagal menyimpan data karna judul Tugas Akhir sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/prestasi')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $tugasakhir = new TugasAkhir();
        $tugasakhir->judul = $request->judul;
        $tugasakhir->nama_mahasiswa = $request->nama_mahasiswa;
        $tugasakhir->bentuk = $request->bentuk;
        
        // Mengisi ID pengguna yang sedang autentikasi
        $tugasakhir->id = Auth::id();

        $tugasakhir->save();

        return redirect('/riwayat-pengajuan')
            ->with('message', 'Data tugas akhir berhasil diajukan, sialahkan tunggu pembaharuan statusnya!')
            ->with('alert_class', 'success');      
    }
}
