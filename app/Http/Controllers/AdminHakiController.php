<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Haki;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Anggota;
use Carbon\Carbon;
use Redirect;
use Session;
use PDF;

class AdminhakiController extends Controller
{
    public function index()
    {
        $user = Users::all();
        $haki = Haki::with('users')->orderBy('created_at', 'DESC')->get();
        
        return view('admin-haki', compact('haki', 'user'));
    }

    public function simpan(Request $request)
    {
        $haki = new Haki();
        $haki->nomor = $request->nomor;
        $haki->tanggal_terbit = $request->tanggal_terbit;
        $haki->judul = $request->judul;
        $haki->nama_mahasiswa = $request->nama_mahasiswa;
        $haki->bentuk = $request->bentuk;
        $haki->status = 'Diterima';
        
        // Mengisi ID pengguna yang sedang autentikasi
        $haki->id = Auth::id();

        $haki->save();

        return redirect('/admin-haki')
            ->with('message', 'Data berhasil ditambah')
            ->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $haki = Haki::where('id_haki',$id)->first();
        return view('haki-edit', compact('haki'));
    }

    public function update(Request $request, $id)
    {
        $haki = Haki::where('id_haki', $id)->first();
            $haki->nomor = $request->nomor;
            $haki->tanggal_terbit = $request->tanggal_terbit;
            $haki->judul = $request->judul;
            $haki->nama_mahasiswa = $request->nama_mahasiswa;
            $haki->bentuk = $request->bentuk;
            $haki->status = 'Diterima';
            $haki->id = Auth::id();
        $haki->save();
        return redirect('/admin-haki')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function status(Request $request, $id)
    {
        $haki = Haki::where('id_haki', $id)->first();
            $haki->status = $request->status;
        $haki->save();
        return redirect('/admin-haki')->with('message', 'Status data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $haki = Haki::findOrFail($id);

        $haki->delete();
        return redirect('/admin-haki')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $user = Users::all();
        $haki = Haki::with('users')->orderBy('created_at', 'DESC')->get();
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
        $currentDate = Carbon::now()->locale('id')->translatedFormat('d F Y');

        $pdf = PDF::loadview('pdf-haki', compact('haki', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data HaKI Mahasiswa.pdf');
    }
}
