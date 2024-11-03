<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request, $category = null)
    {
        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Query untuk mendapatkan event berdasarkan pencarian di semua kolom yang ditentukan
        $event = Event::when($search, function ($query, $search) {
                                return $query->where(function ($query) use ($search) {
                                    $query->where('nama_event', 'like', '%' . $search . '%')
                                          ->orWhere('tanggal', 'like', '%' . $search . '%')
                                          ->orWhere('waktu_mulai', 'like', '%' . $search . '%')
                                          ->orWhere('waktu_selesai', 'like', '%' . $search . '%')
                                          ->orWhere('deskripsi', 'like', '%' . $search . '%')
                                          ->orWhere('lokasi', 'like', '%' . $search . '%')
                                          ->orWhere('penyelenggara', 'like', '%' . $search . '%')
                                          ->orWhere('kategori', 'like', '%' . $search . '%');
                                });
                            })
                            ->when($category, function ($query, $category) {
                                return $query->where('kategori', $category);
                            })
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('waktu_mulai', 'desc')
                            ->get();

        $message = null;
        if ($event->isEmpty()) {
            $message = "Tidak ada event yang ditemukan untuk kata kunci '$search'.";
        }

        return view('event', compact('event', 'message'));
    }
}
