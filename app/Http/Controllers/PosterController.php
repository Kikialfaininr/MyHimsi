<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Poster;
use Redirect;
use Session;
use PDF;
use Image;

class PosterController extends Controller
{
    public function index()
    {
        $poster = Poster::where('status', 'Diterima')->orderBy('created_at', 'DESC')->get();

        return view('poster', compact('poster'));
    }

    public function show($id)
    {
        $poster = Poster::findOrFail($id);
        
        return view('poster-detail', compact('poster'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'unique:poster',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:15000', 
        ], [
            'judul.unique' => 'Gagal menyimpan data karna judul poster sudah ada.',
            'foto.required' => 'Foto harus diupload.', 
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 15MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/poster')->with([
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
        
        // Mengisi ID pengguna yang sedang autentikasi
        $poster->id = Auth::id();

        $poster->save();

        return redirect('/riwayat-pengajuan')
            ->with('message', 'Data berhasil ditambah')
            ->with('alert_class', 'success');      
    }
}
