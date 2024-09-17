@extends('layouts.app')

@section('content')
<div class="cardBox">
    <div class="card">
        <div class="content">
            <div class="numbers">5</div>
            <div class="cardName">Divisi Aktif</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-grid'></i>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <div class="numbers">29</div>
            <div class="cardName">Anggota Aktif</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-group'></i>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <div class="numbers">6</div>
            <div class="cardName">Proker Terlaksana</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-task'></i>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <div class="numbers">9</div>
            <div class="cardName">Event Mendatang</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-calendar'></i>
        </div>
    </div>
</div>

<div class="details">
    <div class="eventsList">
        <div class="cardHeader">
            <h2>Event Mendatang</h2>
            <a href="#" class="btn">Lihat Semua</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Waktu Mulai</td>
                    <td>Waktu Selesai</td>
                    <td>Lokasi</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
                <tr>
                    <td>Rapat Bulanan</td>
                    <td>Senin, 2 September 2024</td>
                    <td>13.00</td>
                    <td>14.00</td>
                    <td>Lab Pemrograman Lanjut</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="latestMembers">
        <div class="cardHeader">
            <h2>Anggota Terbaru</h2>
        </div>
        <table>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="{{ asset('image/profil1.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Evan <br> <span>Anggota Divisi Minat Bakat</span></h4>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
