@extends('layouts.app-general')

@section('content')
    <div class="jarkominfo">
        <div class="division-title">
            <img src="{{ asset('image\banner.png') }}" alt="himsi"
                            class="d-inline-block align-text-center" />
            <div class="text-overlay">
            <h1>Divisi <br><span>Minat Bakat</span></h1>
            <ol>
                <li>Menciptakan lingkungan yang mendukung pertumbuhan individu, pengembangan keterampilan, dan penerapan potensi anggota dalam bidang yang mereka minati.</li>
                <li>Mengarahkan kegiatan yang mendukung perkembangan karier, bakat, hobi, dan pengembangan pribadi anggota.</li>
            </ol>              
        </div>
        </div>

        {{-- anggota divisi --}}
        <div class="division-member">
            <h2 class="heading">Anggota Divisi</h2>
            <h3 class="subheading">Periode 2023/2024</h3>
            <div class="kadiv-content">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="kadiv-bio">
                            <h3>Ketua Divisi</h3>
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
                    <div class="col-md-5">
                        <div class="kadiv-img">
                            <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                                class="d-inline-block align-text-center" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="member-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="member-img">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                                    class="d-inline-block align-text-center" />
                            </div>
                            <div class="member-bio">
                                <h3>Anggota</h3>
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
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="member-img">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                                    class="d-inline-block align-text-center" />
                            </div>
                            <div class="member-bio">
                                <h3>Anggota</h3>
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
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="member-img">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="himsi"
                                    class="d-inline-block align-text-center" />
                            </div>
                            <div class="member-bio">
                                <h3>Anggota</h3>
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
                    </div>
                </div>
            </div>
        </div>

        {{-- program kerja --}}
        <div class="division-proker">
            <h2 class="heading">Program Kerja Divisi</h2>
            <h3 class="subheading">Periode 2023/2024</h3>
            <div class="proker-content">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <h2>Januari 2024</h2>
                    </div>
                    <div class="col-md-10">
                        <div class="card">
                            <h2>Program Kerja</h2>
                        <p>Merupakan program Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="proker-content">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <h2>Juli 2024</h2>
                    </div>
                    <div class="col-md-10">
                        <div class="card">
                            <h2>Program Kerja</h2>
                        <p>Merupakan program Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="proker-content">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <h2>September 2024</h2>
                    </div>
                    <div class="col-md-10">
                        <div class="card">
                            <h2>Program Kerja</h2>
                        <p>Merupakan program Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
