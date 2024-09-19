<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Berita;
use Redirect;
use Session;
use PDF;
use Image;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->get();
        
        return view('admin-berita', compact('berita'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-berita')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Berita-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();
    
            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('image/berita/'.$foto));
        }

        $berita = new Berita();
            $berita->foto = $foto;
            $berita->judul_berita = $request->judul_berita;
            $berita->penulis = $request->penulis;
            $berita->deskripsi = $request->deskripsi;
        $berita->save();
        return redirect('/admin-berita')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $berita = Berita::where('id_berita',$id)->first();
        return view('berita-edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-berita')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $berita = Berita::find($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Berita-' . date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            
            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('image/berita/'.$foto));

            // Hapus foto lama jika ada
            if ($berita->foto && file_exists(public_path('image/berita/' . $berita->foto))) {
                unlink(public_path('image/berita/' . $berita->foto));
            }

            // Set foto baru ke variabel berita
            $berita->foto = $foto;
        } else {
            // Jika tidak ada file baru, pertahankan foto lama
            $foto = $berita->foto;
        }

        // Update data berita
            $berita->judul_berita = $request->judul_berita;
            $berita->penulis = $request->penulis;
            $berita->deskripsi = $request->deskripsi;
        $berita->save();

        return redirect('/admin-berita')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $berita->delete();
        return redirect('/admin-berita')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
