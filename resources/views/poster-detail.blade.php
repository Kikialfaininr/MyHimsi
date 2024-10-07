@extends('layouts.app-general')

@section('title', 'My Himsi - Galeri Poster Mahasiswa')

@section('content')
<div class="poster-detail">
    <div class="card">
        <a href="javascript:history.back()" class="btn btn-back">
            <i class='bx bx-left-arrow-alt'></i> Back
        </a>
        <h2>{{ $poster->judul }}</h2>
        <h6>{{ \Carbon\Carbon::parse($poster->created_at)->translatedFormat('l, d F Y') }}</h6>
        <div class="poster-img">
            <a href="{{ asset('image/poster/' . $poster->foto) }}" target="_blank">
                <img src="{{ asset('image/poster/' . $poster->foto) }}" alt="poster"
                    style="width:50%; display: inline-block;" />
            </a>
        </div>
        <p>Sebuah poster {{ $poster->jenis }} oleh:</p>
        <p>
            @php
            $lines = explode("\n", $poster->nama_mahasiswa);
            @endphp

            @if (count($lines) > 1)
            @foreach ($lines as $index => $line)
            {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
            @endforeach
            @else
            {!! nl2br(e($lines[0])) !!}
            @endif
        </p>
    </div>
</div>
@endsection