@extends('layouts.app-general')

@section('title', 'My Himsi - Sertifikat')

@section('content')
    <div class="sertifikat">
        {{-- Title --}}
        <div class="sertifikat-title text-center">
            <h2>Sertifikat</h2>
            <form action="{{ url('sertifikat') }}" method="GET">
                <div class="search-bar">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Cari sertifikat" value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <div class="container sertifikat-content my-5">
            @if ($message)
                <div class="alert alert-warning">{{ $message }}</div>
            @endif
            <div class="row justify-content-center">
                @foreach ($sertifikat as $no => $value)
                    @if ((Auth::check() && Auth::user()->role == 'Anggota') || $value->kategori == 'Umum')
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $value->nama_sertifikat }}</h5>
                                    <div class="card-text">
                                        <a href="{{ $value->link_sertifikat }}" target="_blank"
                                            class="btn btn-primary">Download Sertifikat</a>
                                        <h5 class="card-tag">Kategori: {{ $value->kategori }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
