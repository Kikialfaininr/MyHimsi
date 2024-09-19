<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Divisi;
use Redirect;
use Session;
use PDF;

class AdminDivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::orderBy('created_at', 'desc')->get();
        
        return view('admin-divisi', compact('divisi'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_divisi' => 'unique:divisi',
        ], [
            'nama_divisi.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-divisi')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $divisi = new Divisi();
            $divisi->nama_divisi = $request->nama_divisi;
            $divisi->deskripsi = $request->deskripsi;
        $divisi->save();
        return redirect('/admin-divisi')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $divisi = Divisi::where('id_divisi',$id)->first();
        return view('divisi-edit', compact('divisi'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_divisi' => 'unique:divisi',
        ], [
            'nama_divisi.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-divisi')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $divisi = Divisi::where('id_divisi', $id)->first();
            $divisi->nama_divisi = $request->nama_divisi;
            $divisi->deskripsi = $request->deskripsi;
        $divisi->save();
        return redirect('/admin-divisi')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $divisi = Divisi::findOrFail($id);

        if ($divisi->anggota()->count() > 0 || $divisi->proker()->count() > 0) {
            return redirect('/admin-divisi')->with('error', 'Tidak dapat menghapus divisi karena terdapat anggota dan/atau program kerja yang terkait.');
        }

        $divisi->delete();
        return redirect('/admin-divisi')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $divisi = Divisi::get();

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
        $pdf = PDF::loadview('pdf-divisi', compact('divisi', 'himsiSrc', 'uhbSrc', 'currentDate'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Divisi Himsi.pdf');
    }

}
