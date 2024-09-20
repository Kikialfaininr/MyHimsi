@extends('layouts.app-general')

@section('content')
    <div class="berita-detail">
        <div class="card">
            <h2>{{ $berita->judul_berita }}</h2>
            <h5>{{ $berita->penulis }}</h5>
            <h6>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y') }}</h6>
            <div class="news-img">
                @if ($berita->foto)
                <a href="{{ asset('image/berita/' . $berita->foto) }}" target="_blank">
                    <img src="{{ asset('image/berita/' . $berita->foto) }}" alt="berita"
                        style="width:50%; display: inline-block;" />
                </a>
            @else
                <a href="{{ asset('image/berita.png') }}" target="_blank">
                    <img src="{{ asset('image/berita.png') }}" alt="berita" style="width:50%; display: inline-block;" />
                </a>
            @endif
            </div>
            <p>{{ $berita->deskripsi }}</p>
        </div>
    </div>
@endsection
