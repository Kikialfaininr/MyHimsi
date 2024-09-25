@extends('layouts.app')

@section('content')
<div class="cardBox">
    <div class="card">
        <a href="{{ url('/admin-divisi') }}" class="content"> 
            <div class="numbers">{{ $divisiCount }}</div>
            <div class="cardName">Divisi Aktif</div>
        </a>
        <div class="iconBx">
            <i class='bx bx-grid'></i>
        </div>
    </div>
    <div class="card">
        <a href="{{ url('/admin-anggota') }}" class="content"> 
            <div class="numbers">{{ $anggotaCount }}</div>
            <div class="cardName">Anggota Aktif</div>
        </a>
        <div class="iconBx">
            <i class='bx bx-group'></i>
        </div>
    </div>
    <div class="card">
        <a href="{{ url('/admin-proker') }}" class="content"> 
            <div class="numbers">{{ $prokerCount }}</div>
            <div class="cardName">Program Kerja</div>
        </a>
        <div class="iconBx">
            <i class='bx bx-task'></i>
        </div>
    </div>
    <div class="card">
        <a href="{{ url('/admin-event') }}" class="content"> 
            <div class="numbers">{{ $eventCount }}</div>
            <div class="cardName">Event Mendatang</div>
        </a>
        <div class="iconBx">
            <i class='bx bx-calendar'></i>
        </div>
    </div>
</div>


    <div class="details">
        <div class="eventsList">
            <div class="cardHeader">
                <h2>Event Mendatang</h2>
                <a href="{{ url('/admin-event') }}" class="btn">Lihat Semua</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Event</td>
                        <td>Tanggal</td>
                        <td>Waktu Mulai</td>
                        <td>Waktu Selesai</td>
                        <td>Lokasi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->nama_event }}</td>
                            <td>{{ $event->tanggal }}</td>
                            <td>{{ $event->waktu_mulai }}</td>
                            <td>{{ $event->waktu_selesai }}</td>
                            <td>{{ $event->lokasi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="latestMembers">
            <div class="cardHeader">
                <h2>Anggota Terbaru</h2>
            </div>
            <table>
                @foreach ($latestMembers as $member)
                    <tr>
                        <td width="60px">
                            <div class="imgBx">
                                @if ($member->foto)
                                    <img src="{{ asset('image/anggota/' . $member->foto) }}" alt="profil"
                                        class="d-inline-block align-text-center rounded-circle" />
                                @else
                                    <img src="{{ asset('image/profil.jpg') }}" alt="profil"
                                        class="d-inline-block align-text-center rounded-circle">
                                @endif
                            </div>
                        </td>
                        <td>
                            <h4>{{ $member->full_name }}<br> <span>{{ $member->jabatan->nama_jabatan }} -
                                    {{ $member->divisi->nama_divisi }}</span></h4>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
