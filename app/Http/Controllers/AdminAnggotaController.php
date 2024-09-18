<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Jabatan;
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
        $anggota = Anggota::with(['divisi', 'jabatan'])
                      ->orderBy('created_at', 'DESC')
                      ->get();
        
        return view('admin-anggota', compact('anggota', 'divisi', 'jabatan'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'unique:anggota',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nim.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
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
    
            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('image/anggota/'.$foto));
        }

        $anggota = new Anggota();
            $anggota->foto = $foto;
            $anggota->full_name = $request->full_name;
            $anggota->nim = $request->nim;
            $anggota->angkatan = $request->angkatan;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->id_divisi = $request->id_divisi;
            $anggota->id_jabatan = $request->id_jabatan;
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
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nim.unique' => 'Gagal menyimpan data karena NIM sudah ada.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
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

                $resize_foto = Image::make($file->getRealPath());
                $resize_foto->resize(200, 200, function($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('image/anggota/'.$foto));

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

        $divisi->delete();
        return redirect('/admin-anggota')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $anggota = Anggota::with(['divisi', 'jabatan'])
                      ->orderBy('created_at', 'DESC')
                      ->get();

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
        $pdf = PDF::loadview('pdf-anggota', compact('anggota', 'himsiSrc', 'uhbSrc', 'currentDate'));
        $pdf->setPaper('F4', 'potrait');
        return $pdf->stream('Data Anggota Himsi.pdf');
    }

}