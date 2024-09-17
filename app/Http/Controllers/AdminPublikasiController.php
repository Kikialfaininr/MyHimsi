<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Publikasi;
use Redirect;
use Session;
use PDF;

class AdminPublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::orderBy('created_at', 'desc')->get();
        
        return view('admin-publikasi', compact('publikasi'));
    }

    public function simpan(Request $request)
    {
        $publikasi = new Publikasi();
            $publikasi->nama_jurnal = $request->nama_jurnal;
            $publikasi->indeks = $request->indeks;
            $publikasi->waktu_terbit = $request->waktu_terbit;
            $publikasi->bidang = $request->bidang;
            $publikasi->biaya = $request->biaya;
            $publikasi->link_jurnal = $request->link_jurnal;
        $publikasi->save();
        return redirect('/admin-publikasi')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $publikasi = Publikasi::where('id_publikasi',$id)->first();
        return view('publikasi-edit', compact('publikasi'));
    }

    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::where('id_publikasi', $id)->first();
            $publikasi->nama_jurnal = $request->nama_jurnal;
            $publikasi->indeks = $request->indeks;
            $publikasi->waktu_terbit = $request->waktu_terbit;
            $publikasi->bidang = $request->bidang;
            $publikasi->biaya = $request->biaya;
            $publikasi->link_jurnal = $request->link_jurnal;
        $publikasi->save();
        return redirect('/admin-publikasi')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $publikasi = Publikasi::findOrFail($id);

        $publikasi->delete();
        return redirect('/admin-publikasi')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $publikasi = Publikasi::get();

        // Encode gambar ke base64
        $logoHimsi = public_path('image/logo himsi.png');
        $himsiData = base64_encode(file_get_contents($logoHimsi));
        $himsiSrc = 'data:image/png;base64,' . $himsiData;

        $logoUhb = public_path('image/logo uhb.png');
        $uhbData = base64_encode(file_get_contents($logoUhb));
        $uhbSrc = 'data:image/png;base64,' . $uhbData;

        // Ambil tanggal hari ini
        $currentDate = now()->format('d F Y'); // Format sesuai kebutuhan

        // Pass imageSrc dan currentDate ke view
        $pdf = PDF::loadview('pdf-publikasi', compact('publikasi', 'himsiSrc', 'uhbSrc', 'currentDate'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Publikasi Jurnal.pdf');
    }

}
