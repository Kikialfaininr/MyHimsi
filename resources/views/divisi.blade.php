@extends('layouts.app-general')

@section('content')
    <div class="divisi">
        <div class="division-title">
            <img src="{{ asset('image\banner.png') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
            <div class="text-overlay">
                <h1>
                    Divisi <br>
                    <span>{{ Str::replaceFirst('Divisi ', '', $divisi->nama_divisi) }}</span>
                </h1>
                <p>{{$divisi->deskripsi}}</p>              
            </div>
        </div>

        {{-- anggota divisi --}}
        <div class="division-member">
            <h2 class="heading">Anggota Divisi</h2>
            <h3 class="subheading">{{ $periode->periode }}</h3>
            <div class="kadiv-content">
                @foreach ($anggota as $no => $value)
                @if ($value->jabatan->nama_jabatan == 'Ketua Divisi' && $value->periode->keterangan == 'Aktif')
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="kadiv-bio">
                            <h3>{{ $value->jabatan->nama_jabatan }}</h3>
                            <h2>{{ $value->full_name }}</h2>
                            <h4>{{ $value->angkatan }} - S1 Sistem Informasi</h4>
                            <div class="social-icons">
                                <a href="{{ $value->link_linkedin }}" target="_blank" rel="noopener noreferrer"><i
                                        class='bx bxl-linkedin'></i></a>
                                <a href="{{ $value->link_ig }}" target="_blank" rel="noopener noreferrer"><i
                                        class='bx bxl-instagram-alt'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kadiv-img">
                            @if ($value->foto)
                                <a href="{{ asset('image/anggota/' . $value->foto) }}" target="_blank">
                                    <img src="{{ asset('image/anggota/' . $value->foto) }}" alt="profil"
                                        class="d-inline-block align-text-center" />
                                </a>
                            @else
                                <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                    <img src="{{ asset('image/profil.jpg') }}" alt="profil"
                                        class="d-inline-block align-text-center">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="member-content">
                <div class="row justify-content-center">
                    @foreach ($anggota as $no => $value)
                    @if ($value->jabatan->nama_jabatan == 'Anggota Divisi' && $value->periode->keterangan == 'Aktif')
                    <div class="col-md-4">
                        <div class="card">
                            <div class="member-img">
                                @if ($value->foto)
                                    <a href="{{ asset('image/anggota/' . $value->foto) }}" target="_blank">
                                        <img src="{{ asset('image/anggota/' . $value->foto) }}" alt="profil"
                                            class="d-inline-block align-text-center" />
                                    </a>
                                @else
                                    <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="profil"
                                            class="d-inline-block align-text-center">
                                    </a>
                                @endif
                            </div>
                            <div class="member-bio">
                                <h3>{{ $value->jabatan->nama_jabatan }}</h3>
                                <h2>{{ $value->full_name }}</h2>
                                <h4>{{ $value->angkatan }} - S1 Sistem Informasi</h4>
                                <div class="social-icons">
                                    <a href="{{ $value->link_linkedin }}" target="_blank" rel="noopener noreferrer"><i
                                            class='bx bxl-linkedin'></i></a>
                                    <a href="{{ $value->link_ig }}" target="_blank" rel="noopener noreferrer"><i
                                            class='bx bxl-instagram-alt'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- program kerja --}}
        <div class="division-proker">
            <h2 class="heading">Program Kerja Divisi</h2>
            <h3 class="subheading">{{ $periode->periode }}</h3>
            @foreach ($proker as $no => $value)
                @if ($value->periode->keterangan == "Aktif")
                    <div class="proker-content">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <h2>{{ $value->judul_proker }}</h2>
                            </div>
                            <div class="col-md-10">
                                <div class="card">
                                    <p>{{ $value->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        
    </div>
@endsection
