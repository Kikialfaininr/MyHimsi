@extends('layouts.app-general')

@section('content')
    <div class="event">
        <div class="card">
            <h2>Kegiatan</h2>
            <div class="tags">
                <a href="#">Acara</a>
                <a href="#">Akademik</a>
                <a href="#">Rapat</a>
            </div>
            <div class="search-bar">
                <button type="submit">
                    <i class="bx bx-search"></i>
                </button>
                <input type="text" placeholder="Type to search...">
            </div>
            <div class="event-content">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="event Himsi" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Rapat Bulanan</h5>
                                    <div class="card-text">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-calendar'></i></th>
                                                    <th scope="row">Senin, 2 September 2024</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-time'></i></th>
                                                    <td>13.00 WIB</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-location-plus'></i></th>
                                                    <td>Lab Pemrograman Lanjut</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-link-alt'></i></th>
                                                    <td><a href="" target="_blank" rel="noopener noreferrer">-</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bxs-edit'></i></th>
                                                    <td>Agenda kegiatan bulanan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="card-tag">Tags: Rapat</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="event Himsi" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Webinar Literasi Informasi</h5>
                                    <div class="card-text">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-calendar'></i></th>
                                                    <th scope="row">Rabu, 28 Agustus 2024</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-time'></i></th>
                                                    <td>09.00 WIB</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-location-plus'></i></th>
                                                    <td>Zoom Meeting</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-link-alt'></i></th>
                                                    <td><a href="" target="_blank" rel="noopener noreferrer">Link Pengumuman</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bxs-edit'></i></th>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="card-tag">Tags: Acara</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="event Himsi" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">KRS Online</h5>
                                    <div class="card-text">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-calendar'></i></th>
                                                    <th scope="row">-</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-time'></i></th>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-location-plus'></i></th>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-link-alt'></i></th>
                                                    <td><a href="https://fst.uhb.ac.id" target="_blank" rel="noopener noreferrer">Link Pengumuman</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bxs-edit'></i></th>
                                                    <td>Batas waktu KRS: 30 Agustus</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="card-tag">Tags: Akademik</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset('image\profil1.jpg') }}" alt="event Himsi" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Survei Kepuasan Mahasiswa</h5>
                                    <div class="card-text">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-calendar'></i></th>
                                                    <th scope="row">-</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-time'></i></th>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-location-plus'></i></th>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bx-link-alt'></i></th>
                                                    <td><a href="https://tracerstudy.uhb.ac.id/kepuasan-layanan-kemahasiswaan/" target="_blank" rel="noopener noreferrer">Link Survei</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><i class='bx bxs-edit'></i></th>
                                                    <td>Wajib diisi sebelum tanggal 31 Agustus</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="card-tag">Tags: Akademik</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
