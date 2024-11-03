<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $sertifikat = Sertifikat::when($search, function ($query, $search) {
                return $query->where('nama_sertifikat', 'like', "%{$search}%")
                             ->orWhere('kategori', 'like', "%{$search}%");
            })
            ->when($kategori, function ($query, $kategori) {
                return $query->where('kategori', $kategori);
            })
            ->orderBy('created_at', 'desc')
            ->get();

            $message = null;
            if ($sertifikat->isEmpty()) {
                $message = "Tidak ada sertifikat yang ditemukan untuk kata kunci '$search'.";
            }
    
            return view('sertifikat', compact('sertifikat', 'message'));
    }
}
