<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Anggota;
use App\Models\Proker;
use App\Models\Event;
use App\Models\Periode; // Pastikan Periode model di-import

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil periode aktif
        $periodeAktif = Periode::where('keterangan', 'Aktif')->first();

        // Hitung jumlah divisi dan anggota yang terkait dengan periode aktif
        $divisiCount = Divisi::where('id_periode', $periodeAktif->id_periode)->count();
        $anggotaCount = Anggota::where('id_periode', $periodeAktif->id_periode)->count();

        // Hitung jumlah program kerja dan event yang ada
        $prokerCount = Proker::count();
        $eventCount = Event::where('tanggal', '>', now())->count();

        $events = Event::where('tanggal', '>', now())
                        ->orderBy('tanggal', 'asc')
                        ->get();
        $latestMembers = Anggota::orderBy('created_at', 'desc')->take(5)->get();

        return view('home', [
            'divisiCount' => $divisiCount,
            'anggotaCount' => $anggotaCount,
            'prokerCount' => $prokerCount,
            'eventCount' => $eventCount,
            'events' => $events,
            'latestMembers' => $latestMembers
        ]);
    }
}
