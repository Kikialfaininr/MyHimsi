<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Artikel;
use App\Models\Haki;
use App\Models\TugasAkhir;
use App\Models\Poster;
use Redirect;
use Session;
use PDF;
use Image;

class RiwayatPengajuanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $artikel = Artikel::where('id', $userId)
                          ->orderBy('tahun_terbit', 'DESC')
                          ->get();
        
        $haki = Haki::where('id', $userId)
                     ->orderBy('tanggal_terbit', 'DESC')
                     ->get();
        
        $tugasakhir = TugasAkhir::where('id', $userId)
                                 ->orderBy('created_at', 'DESC')
                                 ->get();

        $poster = Poster::where('id', $userId)
                                 ->orderBy('created_at', 'DESC')
                                 ->get();

        return view('riwayat-pengajuan', compact('artikel', 'haki', 'tugasakhir', 'poster'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'unique:artikel,judul,' . $id . ',id_artikel',
        ], [
            'judul.unique' => 'Gagal menyimpan data karna judul artikel sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/riwayat-pengajuan')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }
        
        $artikel = Artikel::where('id_artikel', $id)->first();
            $artikel->judul = $request->judul;
            $artikel->nama_mahasiswa = $request->nama_mahasiswa;
            $artikel->penerbit = $request->penerbit;
            $artikel->tahun_terbit = $request->tahun_terbit;
            $artikel->link_artikel = $request->link_artikel;
            $artikel->id = Auth::id();
        $artikel->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function updateHaki(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'unique:haki,nomor,' . $id . ',id_haki',
        ], [
            'nomor.unique' => 'Gagal menyimpan data karna nomor HaKI sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/riwayat-pengajuan')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $haki = Haki::where('id_haki', $id)->first();
            $haki->nomor = $request->nomor;
            $haki->tanggal_terbit = $request->tanggal_terbit;
            $haki->judul = $request->judul;
            $haki->nama_mahasiswa = $request->nama_mahasiswa;
            $haki->bentuk = $request->bentuk;
            $haki->id = Auth::id();
        $haki->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function updateTugasakhir(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'unique:tugasakhir,judul,' . $id . ',id_ta',
        ], [
            'judul.unique' => 'Gagal menyimpan data karna judul tugas akhir sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/riwayat-pengajuan')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $tugasakhir = TugasAkhir::where('id_ta', $id)->first();
            $tugasakhir->judul = $request->judul;
            $tugasakhir->nama_mahasiswa = $request->nama_mahasiswa;
            $tugasakhir->bentuk = $request->bentuk;
            $tugasakhir->id = Auth::id();
        $tugasakhir->save();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
    }

    public function updatePoster(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'judul' => 'unique:poster,judul,' . $id . ',id_poster',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            ], [
                'judul.unique' => 'Gagal menyimpan data karna judul poster sudah ada.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 15MB.',
            ]);

            if ($validator->fails()) {
                return redirect('/riwayat-pengajuan')->with([
                    'message' => $validator->errors()->first(),
                    'alert_class' => 'danger'
                ]);
            }

            $poster = Poster::find($id);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $foto = 'Poster-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();

                $image = Image::make($file->getRealPath());
                $image->save(public_path('image/poster/'.$foto), 80);

                // Hapus foto lama jika ada
                if ($poster->foto && file_exists(public_path('image/poster/' . $poster->foto))) {
                    unlink(public_path('image/poster/' . $poster->foto));
                }

                $poster->foto = $foto;
            }

            $poster->nama_mahasiswa = $request->nama_mahasiswa;
            $poster->judul = $request->judul;
            $poster->jenis = $request->jenis;
            $poster->id = Auth::id();
            $poster->save();

            return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil diubah')->with('alert_class', 'success');
        } catch (\Exception $e) {
            return redirect('/riwayat-pengajuan')->with([
                'message' => 'Gagal mengajukan poster: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function hapusArtikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $artikel->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }

    public function hapusHaki(Request $request, $id)
    {
        $haki = Haki::findOrFail($id);

        $haki->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }

    public function hapusTugasakhir(Request $request, $id)
    {
        $tugasakhir = TugasAkhir::findOrFail($id);

        $tugasakhir->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }

    public function hapusPoster(Request $request, $id)
    {
        $poster = Poster::findOrFail($id);

        $poster->delete();
        return redirect('/riwayat-pengajuan')->with('message', 'Pengajuan berhasil dibatalkan')->with('alert_class', 'success');
    }
}
