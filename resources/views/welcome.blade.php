@extends('layouts.app-general')

@section('content')
    {{-- carousel --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('image\bg1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image\bg2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image\bg3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <div class="carousel-caption d-block d-md-block">
            <h3>Selamat Datang</h3>
            <h1>Himpunan Mahasiswa <span>Sistem Informasi</span></h1>
            <div class="social-icons">
                <a href="https://wa.me/087773705521" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-whatsapp'></i></a>
                <a href="mailto:himsiuhb@gmail.com" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-gmail'></i></a>
                <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-instagram-alt'></i></a>
            </div>
        </div>
    </div>

    {{-- definisi --}}
    <div class="definition" id="definition">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="definition-content">
                    <h3 class="text-animation">Mengenal <span></span></h3>
                    <p>Himpunan Mahasiswa Sistem Informasi atau disingkat HIMSI merupakan organisasi kemahasiswaan yang
                        dibentuk guna menjadi wadah dan sarana aktualisasi serta pengembangan diri mahasiswa S1 Sistem
                        Informasi Fakultas Sains dan Teknologi Universitas Harapan Bangsa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="definition-img">
                    <img src="{{ asset('image\logo himsi.png') }}" alt="himsi"
                        class="d-inline-block align-text-center" />
                </div>
            </div>
        </div>
    </div>

    {{-- sejarah --}}
    <div class="history" id="history">
        <h2 class="heading">Sejarah</h2>
        <div class="timeline-items">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">2018</div>
                <div class="timeline-content">
                    <h3>S1 Sistem Informasi</h3>
                    <p>Program Studi S1 Sistem Informasi Fakultas Sains dan Teknologi Universitas Harapan Bangsa (UHB)
                        didirikan pada tanggal 6 September 2018 untuk memenuhi kebutuhan pendidikan tinggi dalam bidang
                        teknologi informasi.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">2022</div>
                <div class="timeline-content">
                    <h3>HIMSI</h3>
                    <p>Himpunan Mahasiswa Sistem Informasi (HIMSI) Universitas Harapan Bangsa dibentuk pada 25 Mei 2022 atas
                        inisiatif Prodi dan mahasiswa. Pada tanggal tersebut, himpunan resmi diperkenalkan di hadapan Prodi,
                        Fakultas, dan Kemahasiswaan. </p>
                </div>
            </div>
        </div>
    </div>

    {{-- visi misi --}}
    <div class="vision" id="vision">
        <h2 class="heading">Visi & Misi</h2>
        <div class="vision-container">
            <div class="vision-box">
                <div class="vision-info">
                    <h4>Visi</h4>
                    <p>Menjadikan himpunan mahasiswa yang dapat menjadi wadah dan sarana aktualisasi serta pengembangan diri
                        bagi mahasiswa program studi sistem informasi baik dalam aspek akademik maupun non-akademik guna
                        mengembangkan program studi.</p>
                </div>
            </div>
            <div class="vision-box">
                <div class="vision-info">
                    <h4>Misi</h4>
                    <ol type="1">
                        <li>Mampu meningkatkan solidaritas dan kebersamaan antara mahasiswa program studi Sistem Informasi.
                        </li>
                        <li>Menjadi wadah kegiatan, penyalur aspirasi, minat bakat, serta tempat bertukar pikiran.</li>
                        <li>Menciptakan hubungan baik dan kerjasama dengan civitas, organisasi, serta lembaga lain khususnya
                            di lingkungan Universitas Harapan Bangsa.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- BPH --}}
    <div class="bph" id="bph">
        <h2 class="heading">Badan Pengurus Harian</h2>
        <h3 class="subheading">{{ $periode->periode }}</h3>
        @foreach ($anggota as $no => $value)
            @if ($value->jabatan->nama_jabatan == 'Ketua Umum')
                <div class="row bph-content">
                    <div class="col-md-6">
                        <div class="bio-bph">
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
                        <div class="img-bph">
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
            @if ($value->jabatan->nama_jabatan == 'Wakil Ketua Umum')
                <div class="row bph-content">
                    <div class="col-md-6">
                        <div class="img-bph">
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
                    <div class="col-md-6">
                        <div class="bio-bph">
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
            @if ($value->jabatan->nama_jabatan == 'Sekretaris')
                <div class="row bph-content">
                    <div class="col-md-6">
                        <div class="bio-bph">
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
                        <div class="img-bph">
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
            @if ($value->jabatan->nama_jabatan == 'Bendahara')
                <div class="row bph-content">
                    <div class="col-md-6">
                        <div class="img-bph">
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
                    <div class="col-md-6">
                        <div class="bio-bph">
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

    {{-- divisi --}}
    <div class="division" id="division">
        <h2 class="heading">Divisi</h2>
        <h3 class="subheading">{{ $periode->periode }}</h3>
        <div class="wrapper">
            <div class="row justify-content-center">
                @foreach ($divisi as $no => $value)
                    @if ($value->nama_divisi !== 'Badan Pengurus Harian')
                        <div class="col-sm-4">
                            <div class="card division-item">
                                <div class="card-body">
                                    <i class='bx bx-briefcase division-icon'></i>
                                    <h2>{{ $value->nama_divisi }}</h2>
                                    <p>{{ $value->deskripsi }}</p>
                                    <a href="{{ url('/divisi/' . $value->id_divisi) }}"
                                        class="btn btn-division">Selengkapnya
                                        <i class='bx bx-right-arrow-alt'></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
