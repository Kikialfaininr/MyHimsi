@extends('layouts.app-general')

@section('title', 'My Himsi - Event')

@section('content')
    <div class="event">
        <div class="card">
            <h2>Kegiatan</h2>
            @if(Auth::check() && Auth::user()->role == 'Anggota')
            <div class="tags">
                <a href="{{url('event')}}">All</a>
                <a href="{{ url('event', ['category' => 'Acara', 'search' => request('search')]) }}">Acara</a>
                    <a href="{{ url('event', ['category' => 'Akademik', 'search' => request('search')]) }}">Akademik</a>
                    <a href="{{ url('event', ['category' => 'Rapat', 'search' => request('search')]) }}">Rapat</a>
            </div>  
            @endif          
            <form action="{{url('event')}}" method="GET">
                <div class="search-bar">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Cari event" value="{{ request('search') }}">
                </div>
            </form>            
            <div class="event-content">
                <div class="row justify-content-center">
                    @foreach ($event as $no => $value)
                    @if (Auth::check() && Auth::user()->role == 'Anggota' || $value->kategori == 'Acara')
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card">
                                @if ($value->foto)
                                    <a href="{{ asset('image/event/' . $value->foto) }}" target="_blank">
                                        <img src="{{ asset('image/event/' . $value->foto) }}" alt="event" class="card-img-top" />
                                    </a>
                                @else
                                    @if ($value->kategori == "Acara")
                                        <a href="{{ asset('image/acara.png') }}" target="_blank">
                                            <img src="{{ asset('image/acara.png') }}" alt="acara" class="card-img-top" />
                                        </a>
                                    @elseif ($value->kategori == "Akademik")
                                        <a href="{{ asset('image/akademik.png') }}" target="_blank">
                                            <img src="{{ asset('image/akademik.png') }}" alt="akademik" class="card-img-top" />
                                        </a>
                                    @elseif ($value->kategori == "Rapat")
                                        <a href="{{ asset('image/rapat.png') }}" target="_blank">
                                            <img src="{{ asset('image/rapat.png') }}" alt="rapat" class="card-img-top" />
                                        </a>
                                    @else
                                        <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                            <img src="{{ asset('image/profil.jpg') }}" alt="profil" class="card-img-top" />
                                        </a>
                                    @endif
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $value->nama_event }}</h5>
                                    <p>Penyelenggara: {{ $value->penyelenggara }}</p>
                                    <div class="card-text">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-calendar'></i></th>
                                                    <th scope="row">{{ \Carbon\Carbon::parse($value->tanggal)->translatedFormat('l, d F Y') }}</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-time'></i></th>
                                                    <td>
                                                        @if($value->waktu_mulai && $value->waktu_selesai)
                                                            {{ $value->waktu_mulai }} - {{ $value->waktu_selesai }}
                                                        @elseif($value->waktu_mulai && is_null($value->waktu_selesai))
                                                            {{ $value->waktu_mulai }} - selesai
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>                                                 
                                                <tr>
                                                    <th scope="col"><i class='bx bx-location-plus'></i></th>
                                                    <td>{{ $value->lokasi ? $value->lokasi : '-' }}</td>
                                                </tr>                                                 
                                                <tr>
                                                    <th scope="col"><i class='bx bx-link-alt'></i></th>
                                                    <td>
                                                        @if($value->link_kegiatan)
                                                            <a href="{{ $value->link_kegiatan }}" target="_blank" rel="noopener noreferrer">Link Kegiatan</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>                                                 
                                                <tr>
                                                    <th scope="col"><i class='bx bxs-edit'></i></th>
                                                    <td>{{ $value->deskripsi }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="card-tag">Tags: {{ $value->kategori }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
