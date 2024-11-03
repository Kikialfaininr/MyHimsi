@extends('layouts.app-general')

@section('title', 'My Himsi - Galeri Poster Mahasiswa')

@section('content')
    <div class="poster">
        <div class="card">
            <h2>Galeri Poster <span>Mahasiswa</span></h2>
            @if (Auth::check() && Auth::user()->role == 'Anggota')
                <div class="menu">
                    <div class="card text-bg-primary">
                        <p>Jika Sobat Himsi memiliki poster penelitian, pengabdian, tugas akhir, dan sebagianya, ajukan
                            sekarang untuk dapat
                            dimuat dalam halaman Galeri Poster Mahasiswa!</p>
                        <div class="row">
                            <div class="col-md-9">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#PengajuanPoster">Pengajuan Poster</a>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ url('riwayat-pengajuan') }}"><i class='bx bx-history'></i> Riwayat Pengajuan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-12 col-xs-12">
                <div class="alertCrd">
                    @if (session()->has('message'))
                        @php
                            $alertClass = session('alert_class', 'success');
                        @endphp

                        <div class="alert alert-{{ $alertClass }}">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="poster-content">
                <div class="row justify-content-center">
                    @foreach ($poster as $no => $value)
                        <div class="col-md-3">
                            <a href="{{ url('poster/' . $value->id_poster) }}" class="text-decoration-none text-dark">
                                <div class="card">
                                    <img src="{{ asset('image/poster/' . $value->foto) }}" alt="poster"
                                        class="d-inline-block align-text-center" />
                                    <div class="card-body text-center">
                                        <p class="card-text">
                                            {{ \Carbon\Carbon::parse($value->created_at)->translatedFormat('l, d F Y') }}
                                        </p>
                                        <h5 class="card-title">{{ $value->judul }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="PengajuanPoster" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pengajuan Poster</h4>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('simpan-data-poster-anggota') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="foto" class="required-label">{{ __('Foto Poster') }}</label>
                            <input id="foto" onchange="readFoto(event)" type="file"
                                class="form-control @error('foto') is-invalid @enderror" name="foto"
                                value="{{ old('foto') }}" required autofocus>
                            <img id="output" style="width: 100px;">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                            <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa"
                                value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                            @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang
                                menjadi pencipta poster dengan memisahkannya menggunakan enter tanpa pejudulan.</p>
                        </div>
                        <div>
                            <label for="judul" class="required-label">{{ __('Judul Poster') }}</label>
                            <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" value="{{ old('judul') }}" required autofocus>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="jenis" class="required-label">{{ __('Jenis Poster') }}</label>
                            <input id="jenis" type="text" class="form-control @error('jenis') is-invalid @enderror"
                                name="jenis" value="{{ old('jenis') }}" required autofocus>
                            @error('jenis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-md-end"></label>
                            <div class="col-md-8">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
