<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\TugasAkhir;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Anggota;
use Redirect;
use Session;
use PDF;

class AdminTugasAkhirController extends Controller
{
    public function index()
    {
        $user = Users::all();
        $tugasakhir = TugasAkhir::with('users')->orderBy('created_at', 'DESC')->get();
        
        return view('admin-tugasakhir', compact('tugasakhir', 'user'));
    }

    public function simpan(Request $request)
    {
        $tugasakhir = new TugasAkhir();
        $tugasakhir->judul = $request->judul;
        $tugasakhir->nama_mahasiswa = $request->nama_mahasiswa;
        $tugasakhir->bentuk = $request->bentuk;
        $tugasakhir->status = 'Diterima';
        
        // Mengisi ID pengguna yang sedang autentikasi
        $tugasakhir->id = Auth::id();

        $tugasakhir->save();

        return redirect('/admin-tugasakhir')
            ->with('message', 'Data berhasil ditambah')
            ->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::where('id_ta',$id)->first();
        return view('tugasakhir-edit', compact('tugasakhir'));
    }

    public function update(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::where('id_ta', $id)->first();
            $tugasakhir->judul = $request->judul;
            $tugasakhir->nama_mahasiswa = $request->nama_mahasiswa;
            $tugasakhir->bentuk = $request->bentuk;
            $tugasakhir->status = 'Diterima';
            $tugasakhir->id = Auth::id();
        $tugasakhir->save();
        return redirect('/admin-tugasakhir')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function status(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::where('id_ta', $id)->first();
            $tugasakhir->status = $request->status;
        $tugasakhir->save();
        return redirect('/admin-tugasakhir')->with('message', 'Status data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::findOrFail($id);

        $tugasakhir->delete();
        return redirect('/admin-tugasakhir')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $user = Users::all();
        $tugasakhir = TugasAkhir::with('users')->orderBy('created_at', 'DESC')->get();
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

        $pdf = PDF::loadview('pdf-tugasakhir', compact('tugasakhir', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Tugas Akhir Mahasiswa.pdf');
    }
}
