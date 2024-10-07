@extends('layouts.app-general')

@section('title', 'My Himsi - Berita')

@section('content')
    <div class="berita">
        <div class="card">
            <h2>Berita <span>Kegiatan</span></h2>
            <form action="{{url('berita')}}" method="GET">
                <div class="search-bar">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Cari judul berita" value="{{ request('search') }}">
                </div>
            </form>  
            <div class="berita-content">
                <div class="row justify-content-center">
                    @foreach ($berita as $no => $value)
                    <div class="col-md-3">
                        <a href="{{ url('berita/' . $value->id_berita) }}" class="text-decoration-none text-dark">
                            <div class="card">
                                @if ($value->foto)
                                            <img src="{{ asset('image/berita/' . $value->foto) }}" alt="berita"
                                                class="d-inline-block align-text-center" />
                                    @else
                                            <img src="{{ asset('image/berita.png') }}" alt="berita"
                                                class="d-inline-block align-text-center" />
                                    @endif
                                <div class="card-body text-center">
                                    <p class="card-text">{{ \Carbon\Carbon::parse($value->created_at)->translatedFormat('l, d F Y') }}</p>
                                    <h5 class="card-title">{{ $value->judul_berita }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
