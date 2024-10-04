<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Poster;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Anggota;
use Redirect;
use Session;
use PDF;
use Image;

class AdminposterController extends Controller
{
    public function index()
    {
        $user = Users::all();
        $poster = Poster::with('users')->orderBy('created_at', 'DESC')->get();
        
        return view('admin-poster', compact('poster', 'user'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:15000', 
        ], [
            'foto.required' => 'Foto harus diupload.', 
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 15MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-poster')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Poster-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();
        
            $image = Image::make($file->getRealPath());
            $image->save(public_path('image/poster/'.$foto), 80);
        }

        $poster = new Poster();
        $poster->foto = $foto;
        $poster->nama_mahasiswa = $request->nama_mahasiswa;
        $poster->judul = $request->judul;
        $poster->jenis = $request->jenis;
        $poster->status = 'Diterima';
        
        // Mengisi ID pengguna yang sedang autentikasi
        $poster->id = Auth::id();

        $poster->save();

        return redirect('/admin-poster')
            ->with('message', 'Data berhasil ditambah')
            ->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $poster = poster::where('id_poster',$id)->first();
        return view('poster-edit', compact('poster'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 15MB.',
            ]);

            if ($validator->fails()) {
                return redirect('/admin-poster')->with([
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
            $poster->status = 'Diterima';
            $poster->id = Auth::id();
            $poster->save();

            return redirect('/admin-poster')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
        } catch (\Exception $e) {
            return redirect('/admin-poster')->with([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function status(Request $request, $id)
    {
        $poster = Poster::where('id_poster', $id)->first();
            $poster->status = $request->status;
        $poster->save();
        return redirect('/admin-poster')->with('message', 'Status data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $poster = Poster::findOrFail($id);

        $poster->delete();
        return redirect('/admin-poster')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
