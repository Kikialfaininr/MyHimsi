<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jabatan;
use Redirect;
use Session;
use PDF;

class AdminJabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::orderBy('created_at', 'desc')->get();
        
        return view('admin-jabatan', compact('jabatan'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'unique:jabatan',
        ], [
            'nama_jabatan.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-jabatan')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $jabatan = new Jabatan();
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->deskripsi = $request->deskripsi;
        $jabatan->save();
        return redirect('/admin-jabatan')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $jabatan = Jabatan::where('id_jabatan',$id)->first();
        return view('jabatan-edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::where('id_jabatan', $id)->first();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->deskripsi = $request->deskripsi;
        $jabatan->save();
        return redirect('/admin-jabatan')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        if ($jabatan->anggota()->count() > 0) {
            return redirect('/admin-jabatan')->with('error', 'Tidak dapat menghapus jabatan karena terdapat anggota yang terkait.');
        }

        $jabatan->delete();
        return redirect('/admin-jabatan')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $jabatan = Jabatan::get();

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
        $pdf = PDF::loadview('pdf-jabatan', compact('jabatan', 'himsiSrc', 'uhbSrc', 'currentDate'));
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream('Data Jabatan Himsi.pdf');
    }

}