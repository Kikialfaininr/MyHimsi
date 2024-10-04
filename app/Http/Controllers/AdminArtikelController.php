<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Artikel;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Anggota;
use Redirect;
use Session;
use PDF;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $user = Users::all();
        $artikel = Artikel::with('users')->orderBy('created_at', 'DESC')->get();
        
        return view('admin-artikel', compact('artikel', 'user'));
    }

    public function simpan(Request $request)
    {
        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->nama_mahasiswa = $request->nama_mahasiswa;
        $artikel->penerbit = $request->penerbit;
        $artikel->tahun_terbit = $request->tahun_terbit;
        $artikel->link_artikel = $request->link_artikel;
        $artikel->status = 'Diterima';
        
        // Mengisi ID pengguna yang sedang autentikasi
        $artikel->id = Auth::id();

        $artikel->save();

        return redirect('/admin-artikel')
            ->with('message', 'Data berhasil ditambah')
            ->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $artikel = artikel::where('id_artikel',$id)->first();
        return view('artikel-edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::where('id_artikel', $id)->first();
            $artikel->judul = $request->judul;
            $artikel->nama_mahasiswa = $request->nama_mahasiswa;
            $artikel->penerbit = $request->penerbit;
            $artikel->tahun_terbit = $request->tahun_terbit;
            $artikel->link_artikel = $request->link_artikel;
            $artikel->status = 'Diterima';
            $artikel->id = Auth::id();
        $artikel->save();
        return redirect('/admin-artikel')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function status(Request $request, $id)
    {
        $artikel = Artikel::where('id_artikel', $id)->first();
            $artikel->status = $request->status;
        $artikel->save();
        return redirect('/admin-artikel')->with('message', 'Status data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $artikel->delete();
        return redirect('/admin-artikel')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $user = Users::all();
        $artikel = artikel::with('users')->orderBy('created_at', 'DESC')->get();
        $jabatan = Jabatan::all();
        $anggota = Anggota::with(['divisi', 'jabatan'])
                        ->orderBy('created_at', 'DESC')
                        ->get();

        // Cari anggota dengan jabatan "Ketua Umum"
        $ketuaUmum = Anggota::whereHas('jabatan', function($query) {
            $query->where('nama_jabatan', 'Ketua Umum');
        })->first();

        // Encode gambar ke base64
        $logoHimsi = public_path('image/logo himsi.png');
        $himsiData = base64_encode(file_get_contents($logoHimsi));
        $himsiSrc = 'data:image/png;base64,' . $himsiData;

        $logoUhb = public_path('image/logo uhb.png');
        $uhbData = base64_encode(file_get_contents($logoUhb));
        $uhbSrc = 'data:image/png;base64,' . $uhbData;

        // Ambil tanggal hari ini
        $currentDate = now()->format('d F Y');

        $pdf = PDF::loadview('pdf-artikel', compact('artikel', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Publikasi Artikel Mahasiswa.pdf');
    }
}
