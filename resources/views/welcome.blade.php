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
        <div class="carousel-caption d-none d-md-block">
            <h3>Selamat Datang</h3>
            <h1>Himpunan Mahasiswa <span>Sistem Informasi</span></h1>
            <div class="social-icons">
                <<a href="https://wa.me/087773705521" target="_blank" rel="noopener noreferrer"><i
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

        {{-- BPH --}}
        <div class="bph" id="bph">
            <h2 class="heading">Badan Pengurus Harian</h2>
            <h3 class="subheading">Periode 2023/2024</h3>
            <div class="row bph-content">
                <div class="col-md-6">
                    <div class="bio-bph">
                        <h3>Ketua Umum</h3>
                        <h2>Ulan Juniarti</h2>
                        <h4>2021 - S1 Sistem Informasi</h4>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/ulan-juniarti/" target="_blank"
                                rel="noopener noreferrer"><i class='bx bxl-linkedin'></i></a>
                            <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                                    class='bx bxl-instagram-alt'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-bph">
                        <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
                    </div>
                </div>
            </div>
            <div class="row bph-content">
                <div class="col-md-6">
                    <div class="img-bph">
                        <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bio-bph">
                        <h3>Wakil Ketua Umum</h3>
                        <h2>Evana Anugrah Purwanto</h2>
                        <h4>2022 - S1 Sistem Informasi</h4>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/ulan-juniarti/" target="_blank"
                                rel="noopener noreferrer"><i class='bx bxl-linkedin'></i></a>
                            <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                                    class='bx bxl-instagram-alt'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bph-content">
                <div class="col-md-6">
                    <div class="bio-bph">
                        <h3>Sekretaris</h3>
                        <h2>Ria Suci Nuralizah</h2>
                        <h4>2021 - S1 Sistem Informasi</h4>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/ulan-juniarti/" target="_blank"
                                rel="noopener noreferrer"><i class='bx bxl-linkedin'></i></a>
                            <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                                    class='bx bxl-instagram-alt'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-bph">
                        <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
                    </div>
                </div>
            </div>
            <div class="row bph-content">
                <div class="col-md-6">
                    <div class="img-bph">
                        <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bio-bph">
                        <h3>Bendahara</h3>
                        <h2>Nur Amanah Zaen</h2>
                        <h4>2021 - S1 Sistem Informasi</h4>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/ulan-juniarti/" target="_blank"
                                rel="noopener noreferrer"><i class='bx bxl-linkedin'></i></a>
                            <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                                    class='bx bxl-instagram-alt'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- divisi --}}
        <div class="division" id="division">
            <h2 class="heading">Divisi</h2>
            <h3 class="subheading">Periode 2023/2024</h3>
            <div class="wrapper">
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <div class="card division-item">
                            <div class="card-body">
                                <i class='bx bx-briefcase division-icon'></i>
                                <h2>Divisi Kewirausahaan</h2>
                                <p>Menciptakan kesempatan kewirausahaan, meningkatkan keterampilan berbisnis, dan mendukung anggota himpunan dalam merintis usaha atau proyek yang berorientasi pada keuntungan.</p>
                                <a href="{{ url('/div-kewirausahaan') }}" class="btn btn-division">Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card division-item">
                            <div class="card-body">
                                <i class='bx bx-star division-icon'></i>
                                <h2>Divisi Minat dan Bakat</h2>
                                <p>Menggali dan mengembangkan bakat serta minat mahasiswa dalam berbagai bidang.</p>
                                <a href="{{ url('/div-minatbakat') }}" class="btn btn-division">Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card division-item">
                            <div class="card-body">
                                <i class='bx bx-network-chart division-icon'></i>
                                <h2>Divisi Jaringan Komunikasi dan Informasi</h2>
                                <p>Merencanakan dan mengelola konten di berbagai platform medsos HIMSI untuk meningkatkan keterlibatan anggota dan mempromosikan kegiatan.</p>
                                <a href="{{ url('/div-jarkominfo') }}" class="btn btn-division">Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-sm-4">
                        <div class="card division-item">
                            <div class="card-body">
                                <i class='bx bx-group division-icon'></i>
                                <h2>Divisi Sosial dan Kemasyarakatan</h2>
                                <p>Menggerakkan kepedulian mahasiswa dan membawa perubahan positif di masyarakat. Mengembangkan program-program yang berorientasi pada pelayanan dan pengabdian kepada masyarakat.</p>
                                <a href="{{ url('/div-sosmas') }}" class="btn btn-division">Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card division-item">
                            <div class="card-body">
                                <i class='bx bx-book division-icon'></i>
                                <h2>Divisi Pendidikan dan Penalaran</h2>
                                <p>Fokus pada meningkatkan pemahaman, pengetahuan, dan keterampilan anggota melalui berbagai kegiatan pendidikan dan penalaran.</p>
                                <a href="{{ url('/div-pendidikan') }}" class="btn btn-division">Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
