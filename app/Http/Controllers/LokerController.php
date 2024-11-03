<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;

class LokerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $loker = Loker::when($search, function ($query, $search) {
            return $query->where('posisi', 'like', "%{$search}%")
                         ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                         ->orWhere('lokasi', 'like', "%{$search}%")
                         ->orWhere('jenis_pekerjaan', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        $message = null;
        if ($loker->isEmpty()) {
            $message = "Tidak ada lowongan yang ditemukan untuk kata kunci '$search'.";
        }

        return view('loker', compact('loker', 'message'));
    }
}
