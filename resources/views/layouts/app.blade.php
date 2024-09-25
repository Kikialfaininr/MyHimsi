<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Himsi</title>
    <link rel="icon" href="{{ asset('image\logo himsi.png') }}" type="image">

    <!-- Font Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('css\style.css') }}">

    <!-- DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="app">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="{{ asset('image\logo himsi.png') }}" alt="himsi" width="40px"
                                class="d-inline-block align-text-center" />
                        </span>
                        <span class="title">My Himsi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/home') }}">
                        <span class="icon">
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-users') }}">
                        <span class="icon">
                            <i class='bx bx-log-in-circle'></i>
                        </span>
                        <span class="title">Data Login</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-periode') }}">
                        <span class="icon">
                            <i class='bx bx-time'></i>
                        </span>
                        <span class="title">Periode</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-divisi') }}">
                        <span class="icon">
                            <i class='bx bx-grid'></i>
                        </span>
                        <span class="title">Divisi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-jabatan') }}">
                        <span class="icon">
                            <i class='bx bx-shield'></i>
                        </span>
                        <span class="title">Jabatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-anggota') }}">
                        <span class="icon">
                            <i class='bx bx-group'></i>
                        </span>
                        <span class="title">Anggota</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-proker') }}">
                        <span class="icon">
                            <i class='bx bx-task'></i>
                        </span>
                        <span class="title">Program Kerja</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-event') }}">
                        <span class="icon">
                            <i class='bx bx-calendar'></i>
                        </span>
                        <span class="title">Event</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-berita') }}">
                        <span class="icon">
                            <i class='bx bx-news'></i>
                        </span>
                        <span class="title">Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-publikasi') }}">
                        <span class="icon">
                            <i class='bx bx-book'></i>
                        </span>
                        <span class="title">Publikasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-sertifikat') }}">
                        <span class="icon">
                            <i class='bx bx-award'></i>
                        </span>
                        <span class="title">Sertifikat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-loker') }}">
                        <span class="icon">
                            <i class='bx bx-briefcase'></i>
                        </span>
                        <span class="title">Lowongan Kerja</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class='bx bx-menu'></i>
                </div>
                <div class="user">
                    @guest
                        @if (Route::has('login'))
                            <a class="btn btn-navbar" href='{{ route('login') }}'>
                                {{ __('Login') }}
                            </a>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                    @endguest
                </div>
            </div>

            <main class="py-4">
                @yield('content')
            </main>

        </div>
    </div>
    <script>
        let list = document.querySelectorAll(".navigation li");

        function activeLink() {
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            this.classList.add("hovered");
        }

        list.forEach((item) => item.addEventListener("mouseover", activeLink));

        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function() {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };
    </script>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    @stack('scripts')
</body>

</html>
