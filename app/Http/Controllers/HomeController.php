<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Anggota;
use App\Models\Proker;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $divisiCount = Divisi::count();
        $anggotaCount = Anggota::count();
        $prokerCount = Proker::count();
        $eventCount = Event::where('tanggal', '>', now())->count();

        $events = Event::where('tanggal', '>', now())
                        ->orderBy('tanggal', 'asc') 
                        ->get();
        $latestMembers = Anggota::orderBy('created_at', 'desc')->take(7)->get();

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