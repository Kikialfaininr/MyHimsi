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

        // Query untuk mendapatkan event berdasarkan search dan/atau category
        $event = Event::when($search, function ($query, $search) {
                                return $query->where('nama_event', 'like', '%' . $search . '%');
                            })
                            ->when($category, function ($query, $category) {
                                return $query->where('kategori', $category);
                            })
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('waktu_mulai', 'desc')
                            ->get();

        return view('event', compact('event'));
    }
}
