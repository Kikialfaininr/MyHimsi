<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Periode;
use Carbon\Carbon;
use Redirect;
use Session;
use DB;
use PDF;
use Image;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $periode = Periode::all();
        $anggota = Anggota::with(['divisi', 'jabatan', 'periode'])
                      ->orderBy('created_at', 'DESC')
                      ->get();
        
        return view('admin-anggota', compact('anggota', 'divisi', 'jabatan', 'periode'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'unique:anggota',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ], [
            'nim.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 10MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-anggota')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Anggota-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();
    
            $image = Image::make($file->getRealPath());
            $image->save(public_path('image/anggota/'.$foto), 80);
        }

        $anggota = new Anggota();
            $anggota->foto = $foto;
            $anggota->full_name = $request->full_name;
            $anggota->nim = $request->nim;
            $anggota->angkatan = $request->angkatan;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->id_divisi = $request->id_divisi;
            $anggota->id_jabatan = $request->id_jabatan;
            $anggota->id_periode = $request->id_periode;
            $anggota->link_ig = $request->link_ig;
            $anggota->link_linkedin = $request->link_linkedin;
        $anggota->save();
        return redirect('/admin-anggota')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $anggota = Anggota::where('id_anggota',$id)->first();
        return view('anggota-edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nim' => 'unique:anggota,nim,' . $id . ',id_anggota',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            ], [
                'nim.unique' => 'Gagal menyimpan data karena NIM sudah ada.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 10MB.',
            ]);

            if ($validator->fails()) {
                return redirect('/admin-anggota')->with([
                    'message' => $validator->errors()->first(),
                    'alert_class' => 'danger'
                ]);
            }

            $anggota = Anggota::find($id);

            // Check if the "hapus_foto" checkbox is checked
            if ($request->has('hapus_foto')) {
                // Hapus foto lama jika ada
                if ($anggota->foto && file_exists(public_path('image/anggota/' . $anggota->foto))) {
                    unlink(public_path('image/anggota/' . $anggota->foto));
                }
                $anggota->foto = null; // Set foto to null in the database
            }

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $foto = 'Anggota-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();

                $image = Image::make($file->getRealPath());
                $image->save(public_path('image/anggota/'.$foto), 80);

                // Hapus foto lama jika ada
                if ($anggota->foto && file_exists(public_path('image/anggota/' . $anggota->foto))) {
                    unlink(public_path('image/anggota/' . $anggota->foto));
                }

                $anggota->foto = $foto;
            }

            // Update data anggota
            $anggota->full_name = $request->full_name;
            $anggota->nim = $request->nim;
            $anggota->angkatan = $request->angkatan;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->id_divisi = $request->id_divisi;
            $anggota->id_jabatan = $request->id_jabatan;
            $anggota->id_periode = $request->id_periode;
            $anggota->link_ig = $request->link_ig;
            $anggota->link_linkedin = $request->link_linkedin;
            $anggota->save();

            return redirect('/admin-anggota')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
        } catch (\Exception $e) {
            // Tangkap error dan berikan alert kepada user
            return redirect('/admin-anggota')->with([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function hapus(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        if ($anggota->users()->count() > 0) {
            return redirect('/admin-anggota')->with('error', 'Tidak dapat menghapus anggota karena terdapat data login yang terkait.');
        }

        $anggota->delete();
        return redirect('/admin-anggota')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $periode = Periode::all();
        $anggota = Anggota::with(['divisi', 'jabatan', 'periode'])
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

        $pdf = PDF::loadview('pdf-anggota', compact('anggota', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'landscape');
        return $pdf->stream('Data Anggota Himsi.pdf');
    }

    public function downloadpdfByPeriode(Request $request)
    {
        $periodeId = $request->input('periode');
        $anggota = Anggota::with(['divisi', 'jabatan', 'periode'])
                      ->where('id_periode', $periodeId)
                      ->orderBy('created_at', 'DESC')
                      ->get();
        $periode = Periode::find($periodeId);
    
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
    
        $sanitizedPeriode = str_replace(['/', '\\'], '-', $periode->periode);
    
        $pdf = PDF::loadview('pdf-anggota-periode', compact('anggota', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum', 'periode'));
        $pdf->setPaper('F4', 'landscape');
        return $pdf->stream('Data Anggota Periode ' . $sanitizedPeriode . '.pdf');
    }
}