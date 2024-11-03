@extends('layouts.app-general')

@section('title', 'My Himsi - Prestasi Mahasiswa')

@section('content')
    <div class="prestasi">
        @if (Auth::check() && Auth::user()->role == 'Anggota')
            <div class="menu">
                <div class="card text-bg-primary">
                    <p>Jika Sobat Himsi memiliki Artikel, HaKI, atau Tugas Akhir, ajukan sekarang untuk mendapatkan
                        pengakuan dalam halaman Prestasi Himsi!</p>
                    <div class="row">
                        <div class="col-md-9">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#PengajuanArtikel">Pengajuan Artikel</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#PengajuanHaki">Pengajuan HaKI</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#PengajuanTA">Pengajuan Tugas Akhir</a>
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
        <div class="artikel">
            <div class="card">
                <h2 class="heading">Publikasi Artikel Mahasiswa HIMSI</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="artikelTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Author Mahasiswa</th>
                                    <th class="text-center">Judul Artikel</th>
                                    <th class="text-center">Penerbit</th>
                                    <th class="text-center">Tahun Publikasi</th>
                                    <th class="text-center">Link Artikel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikel as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp

                                            @if (count($lines) > 1)
                                                @foreach ($lines as $index => $line)
                                                    {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                                @endforeach
                                            @else
                                                {!! nl2br(e($lines[0])) !!}
                                            @endif
                                        </td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->penerbit }}</td>
                                        <td>{{ $value->tahun_terbit }}</td>
                                        <td>
                                            <a href="{{ $value->link_artikel }}"
                                                target="_blank">{{ $value->link_artikel }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="haki">
            <div class="card">
                <h2 class="heading">HaKI Mahasiswa HIMSI</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="hakiTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mahasiswa Pencipta</th>
                                    <th class="text-center">Nomor Paten</th>
                                    <th class="text-center">Tanggal Terbit</th>
                                    <th class="text-center">Judul Ciptaan</th>
                                    <th class="text-center">Jenis Ciptaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($haki as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp

                                            @if (count($lines) > 1)
                                                @foreach ($lines as $index => $line)
                                                    {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                                @endforeach
                                            @else
                                                {!! nl2br(e($lines[0])) !!}
                                            @endif
                                        </td>
                                        <td>{{ $value->nomor }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->tanggal_terbit)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->bentuk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tugas-akhir">
            <div class="card">
                <h2 class="heading">Tugas Akhir Mahasiswa Himsi</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="TATable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Mahasiswa</th>
                                    <th class="text-center">Judul Tugas Akhir</th>
                                    <th class="text-center">Jenis Tugas Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugasakhir as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp

                                            @if (count($lines) > 1)
                                                @foreach ($lines as $index => $line)
                                                    {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                                @endforeach
                                            @else
                                                {!! nl2br(e($lines[0])) !!}
                                            @endif
                                        </td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->bentuk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->role == 'Anggota')
        <div class="modal" id="PengajuanArtikel" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pengajuan Data Artikel</h4>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('simpan-data-artikel-anggota') }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Author Mahasiswa') }}</label>
                                <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa"
                                    value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                                @error('nama_mahasiswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa
                                    yang menjadi penulis artikel dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Artikel') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ old('judul') }}" required autofocus>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="penerbit" class="required-label">{{ __('Penerbit') }}</label>
                                <input id="penerbit" type="text"
                                    class="form-control @error('penerbit') is-invalid @enderror" name="penerbit"
                                    value="{{ old('penerbit') }}" required autofocus>
                                @error('penerbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="tahun_terbit" class="required-label">{{ __('Tahun Publikasi') }}</label>
                                <input id="tahun_terbit" type="number"
                                    class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit"
                                    value="{{ old('tahun_terbit') }}" required autofocus>
                                @error('tahun_terbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="link_artikel" class="required-label">{{ __('Link Artikel') }}</label>
                                <input id="link_artikel" type="text"
                                    class="form-control @error('link_artikel') is-invalid @enderror" name="link_artikel"
                                    value="{{ old('link_artikel') }}" required autofocus>
                                @error('link_artikel')
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

        <div class="modal" id="PengajuanHaki" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data HaKI</h4>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('simpan-data-haki-anggota') }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                                <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                    name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                                @error('nama_mahasiswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa
                                    yang menjadi pencipta HaKI dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="nomor" class="required-label">{{ __('Nomor Paten') }}</label>
                                <input id="nomor" type="text"
                                    class="form-control @error('nomor') is-invalid @enderror" name="nomor"
                                    value="{{ old('nomor') }}" required autofocus>
                                @error('nomor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_terbit" class="required-label">{{ __('Tanggal Terbit') }}</label>
                                <input id="tanggal_terbit" type="date"
                                    class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                    name="tanggal_terbit" value="{{ old('tanggal_terbit') }}" required autofocus>
                                @error('tanggal_terbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Ciptaan') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ old('judul') }}" required autofocus>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="bentuk" class="required-label">{{ __('Jenis Ciptaan') }}</label>
                                <input id="bentuk" type="text"
                                    class="form-control @error('bentuk') is-invalid @enderror" name="bentuk"
                                    value="{{ old('bentuk') }}" required autofocus>
                                @error('bentuk')
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

        <div class="modal" id="PengajuanTA" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Tugas Akhir</h4>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('simpan-data-tugasakhir-anggota') }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Nama Mahasiswa') }}</label>
                                <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                    name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                                @error('nama_mahasiswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa
                                    yang menjadi penulis tugas akhir dengan memisahkannya menggunakan enter tanpa penomoran.
                                </p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Tugas Akhir') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ old('judul') }}" required autofocus>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="bentuk" class="required-label">{{ __('Jenis Tugas Akhir') }}</label>
                                <input id="bentuk" type="text"
                                    class="form-control @error('bentuk') is-invalid @enderror" name="bentuk"
                                    value="{{ old('bentuk') }}" required autofocus>
                                @error('bentuk')
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
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#artikelTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
                $('#hakiTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
                $('#TATable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
            });
        </script>
    @endpush
@endsection
