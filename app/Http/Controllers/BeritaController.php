<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $berita = Berita::when($search, function ($query, $search) {
            return $query->where('judul_berita', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        $message = null;
        if ($berita->isEmpty()) {
            $message = "Tidak ada berita yang ditemukan untuk kata kunci '$search'.";
        }

        return view('berita', compact('berita', 'message'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        
        return view('berita-detail', compact('berita'));
    }
}
