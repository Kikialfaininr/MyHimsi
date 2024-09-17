@extends('layouts.app-general')

@section('content')
    <div class="berita">
        <div class="card">
            <h2>Berita <span>Kegiatan</span></h2>
            <div class="search-bar">
                <button type="submit">
                    <i class="bx bx-search"></i>
                </button>
                <input type="text" placeholder="Type to search...">
            </div>
            <div class="berita-content">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="Berita Himsi">
                                <div class="card-body text-center">
                                    <p class="card-text">Purwokerto, 21 Agustus 2024</p>
                                    <h5 class="card-title">Mahasiswa S1 Sistem Informasi memenangkan penghargaan dari Google</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="Berita Himsi">
                                <div class="card-body text-center">
                                    <p class="card-text">Purwokerto, 21 Agustus 2024</p>
                                    <h5 class="card-title">Mahasiswa S1 Sistem Informasi memenangkan penghargaan dari Google</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="Berita Himsi">
                                <div class="card-body text-center">
                                    <p class="card-text">Purwokerto, 21 Agustus 2024</p>
                                    <h5 class="card-title">Mahasiswa S1 Sistem Informasi memenangkan penghargaan dari Google</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="Berita Himsi">
                                <div class="card-body text-center">
                                    <p class="card-text">Purwokerto, 21 Agustus 2024</p>
                                    <h5 class="card-title">Mahasiswa S1 Sistem Informasi memenangkan penghargaan dari Google</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
