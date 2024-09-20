<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $publikasi = Publikasi::when($search, function ($query, $search) {
            return $query->where('nama_jurnal', 'like', "%{$search}%")
                         ->orWhere('waktu_terbit', 'like', "%{$search}%")
                         ->orWhere('indeks', 'like', "%{$search}%")
                         ->orWhere('bidang', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        return view('publikasi', compact('publikasi'));
    }
}
