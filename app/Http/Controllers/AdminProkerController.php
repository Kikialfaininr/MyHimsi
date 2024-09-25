<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Proker;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Anggota;
use App\Models\Periode;
use Redirect;
use Session;
use PDF;

class AdminProkerController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        $periode = Periode::all();
        $proker = Proker::with('divisi', 'periode')->orderBy('created_at', 'DESC')->get();
        
        return view('admin-proker', compact('proker', 'divisi', 'periode'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_proker' => 'unique:proker',
        ], [
            'judul_proker.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-proker')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $proker = new Proker();
            $proker->judul_proker = $request->judul_proker;
            $proker->deskripsi = $request->deskripsi;
            $proker->id_divisi = $request->id_divisi;
            $proker->id_periode = $request->id_periode;
        $proker->save();
        return redirect('/admin-proker')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $proker = Proker::where('id_proker',$id)->first();
        return view('proker-edit', compact('proker'));
    }

    public function update(Request $request, $id)
    {
        $proker = Proker::where('id_proker', $id)->first();
            $proker->judul_proker = $request->judul_proker;
            $proker->deskripsi = $request->deskripsi;
            $proker->id_divisi = $request->id_divisi;
            $proker->id_periode = $request->id_periode;
        $proker->save();
        return redirect('/admin-proker')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $proker = Proker::findOrFail($id);

        $proker->delete();
        return redirect('/admin-proker')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $divisi = Divisi::all();
        $periode = Periode::all();
        $proker = Proker::with('divisi', 'periode')->orderBy('created_at', 'DESC')->get();
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

        $pdf = PDF::loadview('pdf-proker', compact('proker', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Proker Himsi.pdf');
    }

}
