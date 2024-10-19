<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" href="{{ asset('image\logo himsi.png') }}" type="image">

    <!-- Font Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('css\style-general.css') }}">

    <!-- DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        {{-- navbar --}}
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('image\logo himsi.png') }}" alt="himsi" width="60px"
                        class="d-inline-block align-text-center" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/prestasi') }}">Prestasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/poster') }}">Galeri Poster</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/event') }}">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/berita') }}">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/sertifikat') }}">Sertifikat</a>
                        </li>
                        @if (Auth::check() && Auth::user()->role == 'Anggota')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/publikasi') }}">Publikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/loker') }}">Loker</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/arsip') }}">Arsip</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex">
                    @guest
                        @if (Route::has('login'))
                            <a class="btn btn-navbar" href='{{ route('login') }}'>
                                {{ __('Login') }}
                            </a>
                        @endif
                    @else
                        <div class="user">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    @php
                                        $foto = '';

                                        if (Auth::user()->role == 'Admin') {
                                            $foto = asset('image/admin.jpeg');
                                        } elseif (Auth::user()->role == 'Pengurus') {
                                            $foto = asset('image/pengurus.jpeg');
                                        } elseif (Auth::user()->role == 'Anggota') {
                                            $anggota = \App\Models\Anggota::where(
                                                'id_anggota',
                                                Auth::user()->id_anggota,
                                            )->first();
                                            if ($anggota && $anggota->foto) {
                                                $foto = asset('image/anggota/' . $anggota->foto);
                                            } else {
                                                $foto = asset('image/profil.jpg');
                                            }
                                        } else {
                                            $foto = asset('image/profil.jpg');
                                        }
                                    @endphp

                                    <img src="{{ $foto }}" alt="User Avatar" class="user-avatar me-2">
                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::check() && Auth::user()->role == 'Anggota')
                                        <a class="dropdown-item" href="{{ url('/profil-anggota') }}">
                                            {{ __('Profil anggota') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ url('/riwayat-pengajuan') }}">
                                            {{ __('Riwayat Pengajuan Prestasi') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        {{-- content --}}
        <main class="py-4">
            @yield('content')
        </main>

        {{-- footer --}}
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('image/logo himsi.png') }}" alt="Logo" class="footer-logo-img">
                    <h3>Himpunan Mahasiswa <br> Sistem Informasi</h3>
                    <p>JL. K.H. Wahid Hasyim, No. 274-A, Windusara, Karangklesem, Kec. Purwokerto Sel., Kabupaten
                        Banyumas, Jawa Tengah 53144</p>
                </div>
                <div class="footer-column">
                    <h3>Profile</h3>
                    <ul>
                        <li><a href="{{ url('/') }}#vision">Visi-Misi</a></li>
                        <li><a href="{{ url('/') }}#division">Divisi</a></li>
                        <li><a href="{{ url('/prestasi') }}">Prestasi</a></li>
                        <li><a href="{{ url('/poster') }}">Galeri Poster Mahasiswa</a></li>
                        <li><a href="{{ url('/arsip') }}">Arsip</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Website</h3>
                    <ul>
                        <li><a href="https://uhb.ac.id/s1-sistem-informasi/"
                                target="_blank">Prodi S1 Sistem Informasi</a></li>
                        <li><a href="https://www.uhb.ac.id/id/" target="_blank">Universitas Harapan Bangsa</a></li>
                        <li><a href="https://ejournal.uhb.ac.id/index.php/IKOMTI" target="_blank">Jurnal IKOMTI</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Maps</h3>
                    <div class="map-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.1457469738784!2d109.24050117371971!3d-7.449122873406023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655de2b7be3c8b%3A0xb7cf22e20eade4d!2sUniversitas%20Harapan%20Bangsa%2C%20Kampus%20B!5e0!3m2!1sid!2sid!4v1724655046845!5m2!1sid!2sid"
                            width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="social">
                <a href="https://wa.me/087773705521" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-whatsapp'></i></a>
                <a href="mailto:himsiuhb@gmail.com" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-gmail'></i></a>
                <a href="https://www.instagram.com/himsi.uhb/" target="_blank" rel="noopener noreferrer"><i
                        class='bx bxl-instagram-alt'></i></a>
            </div>
            <hr class="footer-divider">
            <p class="copyright">&copy; 2024 My Himsi. All rights reserved.</p>
            <p class="copyright">Powered by Himpunan Mahasiswa Sistem Informasi</p>
        </footer>
    </div>

    <script>
        document.addEventListener("scroll", function() {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    @stack('scripts')

</body>

</html>
