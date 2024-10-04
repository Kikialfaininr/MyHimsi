@extends('layouts.app-general')

@section('content')
    <div class="riwayatPengajuan">
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
                <h2 class="heading">Riwayat Pengajuan Artikel</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="artikelTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Status Pengajuan</th>
                                    <th class="text-center">Author Mahasiswa</th>
                                    <th class="text-center">Judul Artikel</th>
                                    <th class="text-center">Penerbit</th>
                                    <th class="text-center">Tahun Publikasi</th>
                                    <th class="text-center">Link Artikel</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikel as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @if(is_null($value->status))
                                                <span class="text-warning">Dalam Tinjauan</span>
                                            @else
                                                <span class="{{ $value->status === 'Diterima' ? 'text-success' : 'text-danger' }}">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>                                        
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp
                                            
                                            @if (count($lines) > 1)
                                                @foreach($lines as $index => $line)
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
                                            <a href="{{ $value->link_artikel }}" target="_blank">{{ $value->link_artikel }}</a>
                                        </td>
                                        <td class="action-col">
                                            @if(is_null($value->status))
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#UbahArtikel{{ $value->id_artikel }}" title="Ubah Data">
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                                <a href="{{ url($value->id_artikel . '/hapus-artikel-anggota') }}">
                                                    <button title="Hapus Data" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </a>
                                            @else
                                            <span>
                                                <button class="btn btn-warning btn-sm" disabled>
                                                    Pengajuan telah {{ $value->status }}, hubungi admin jika perlu edit atau hapus data!
                                                </button>
                                            </span>
                                            @endif
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
                <h2 class="heading">Riwayat Pengajuan HaKI</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="hakiTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Status Pengajuan</th>
                                    <th class="text-center">Mahasiswa Pencipta</th>
                                    <th class="text-center">Nomor Paten</th>
                                    <th class="text-center">Tanggal Terbit</th>
                                    <th class="text-center">Judul Ciptaan</th>
                                    <th class="text-center">Jenis Ciptaan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($haki as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @if(is_null($value->status))
                                                <span class="text-warning">Dalam Tinjauan</span>
                                            @else
                                                <span class="{{ $value->status === 'Diterima' ? 'text-success' : 'text-danger' }}">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>                                        
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp
                                            
                                            @if (count($lines) > 1)
                                                @foreach($lines as $index => $line)
                                                    {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                                @endforeach
                                            @else
                                                {!! nl2br(e($lines[0])) !!}
                                            @endif
                                        </td>
                                        <td>{{ $value->nomor }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->bentuk }}</td>
                                        <td class="action-col">
                                            @if(is_null($value->status))
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#UbahHaki{{ $value->id_haki }}" title="Ubah Data">
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                                <a href="{{ url($value->id_haki . '/hapus-haki-anggota') }}">
                                                    <button title="Hapus Data" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </a>
                                            @else
                                                <span>
                                                    <button class="btn btn-warning btn-sm" disabled>
                                                        Pengajuan telah {{ $value->status }}, hubungi admin jika perlu edit atau hapus data!
                                                    </button>
                                                </span>
                                            @endif
                                        </td>
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
                <h2 class="heading">Riwayat Pengajuan Tugas Akhir</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="TATable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Status Pengajuan</th>
                                    <th class="text-center">Nama Mahasiswa</th>
                                    <th class="text-center">Judul Tugas Akhir</th>
                                    <th class="text-center">Jenis Tugas Akhir</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugasakhir as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>
                                            @if(is_null($value->status))
                                                <span class="text-warning">Dalam Tinjauan</span>
                                            @else
                                                <span class="{{ $value->status === 'Diterima' ? 'text-success' : 'text-danger' }}">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>                                        
                                        <td>
                                            @php
                                                $lines = explode("\n", $value->nama_mahasiswa);
                                            @endphp
                                            
                                            @if (count($lines) > 1)
                                                @foreach($lines as $index => $line)
                                                    {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                                @endforeach
                                            @else
                                                {!! nl2br(e($lines[0])) !!}
                                            @endif
                                        </td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->bentuk }}</td>
                                        <td class="action-col">
                                            @if(is_null($value->status))
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#UbahTA{{ $value->id_ta }}" title="Ubah Data">
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                                <a href="{{ url($value->id_ta . '/hapus-tugasakhir-anggota') }}">
                                                    <button title="Hapus Data" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </a>
                                            @else
                                            <span>
                                                <button class="btn btn-warning btn-sm" disabled>
                                                    Pengajuan telah {{ $value->status }}, hubungi admin jika perlu edit atau hapus data!
                                                </button>
                                            </span>
                                            @endif
                                        </td>
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
                <h2 class="heading">Riwayat Pengajuan Poster</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="posterTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pengajuan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Mahasiswa Pencipta</th>
                                    <th class="text-center">Judul Poster</th>
                                    <th class="text-center">Jenis Poster</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($poster as $no => $value)
                                    <tr>
                                        <td align="center">{{ $no + 1 }}</td>
                                        <td>{{ $value->users->name }}</td>
                                        <td>
                                            @if(is_null($value->status))
                                                <span class="text-warning">Dalam Tinjauan</span>
                                            @else
                                                <span class="{{ $value->status === 'Diterima' ? 'text-success' : 'text-danger' }}">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ asset('image/poster/' . $value->foto) }}" target="_blank">
                                                <img src="{{ asset('image/poster/' . $value->foto) }}" alt="poster"
                                                    style="width:100px;" class="d-inline-block align-text-center" />
                                            </a>
                                        </td>
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
                                        <td>{{ $value->jenis }}</td>
                                        <td class="action-col">
                                            @if(is_null($value->status))
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#UbahPoster{{ $value->id_poster }}" title="Ubah Data">
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                                <a href="{{ url($value->id_poster . '/hapus-poster-anggota') }}">
                                                    <button title="Hapus Data" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </a>
                                            @else
                                            <span>
                                                <button class="btn btn-warning btn-sm" disabled>
                                                    Pengajuan telah {{ $value->status }}, hubungi admin jika perlu edit atau hapus data!
                                                </button>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($artikel as $no => $value)
        <div class="modal" id="UbahArtikel{{ $value->id_artikel }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Pengajuan Artikel</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-artikel-anggota/' . $value->id_artikel) }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Author Mahasiswa') }}</label>
                                <textarea id="nama_mahasiswa" 
                                          class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                          name="nama_mahasiswa" 
                                          required autofocus>{{ old('nama_mahasiswa', $value->nama_mahasiswa) }}</textarea>
                                @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang menjadi penulis artikel dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Artikel') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ $value->judul }}" required autofocus>
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
                                    value="{{ $value->penerbit }}" required autofocus>
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
                                    value="{{ $value->tahun_terbit }}" required autofocus>
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
                                    value="{{ $value->link_artikel }}" required autofocus>
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
    @endforeach

    @foreach ($haki as $no => $value)
        <div class="modal" id="UbahHaki{{ $value->id_haki }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Pengajuan HaKI</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-haki-anggota/' . $value->id_haki) }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                                <textarea id="nama_mahasiswa" 
                                          class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                          name="nama_mahasiswa" 
                                          required autofocus>{{ old('nama_mahasiswa', $value->nama_mahasiswa) }}</textarea>
                                @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang menjadi pencipta HaKI dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="nomor" class="required-label">{{ __('Nomor Paten') }}</label>
                                <input id="nomor" type="text"
                                    class="form-control @error('nomor') is-invalid @enderror" name="nomor"
                                    value="{{ $value->nomor }}" required autofocus>
                                @error('nomor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_terbit" class="required-label">{{ __('Tanggal Terbit') }}</label>
                                <input id="tanggal_terbit" type="date"
                                    class="form-control @error('tanggal_terbit') is-invalid @enderror" name="tanggal_terbit"
                                    value="{{ $value->tanggal_terbit }}" required autofocus>
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
                                    value="{{ $value->judul }}" required autofocus>
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
                                    value="{{ $value->bentuk }}" required autofocus>
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
    @endforeach

    @foreach ($tugasakhir as $no => $value)
        <div class="modal" id="UbahTA{{ $value->id_ta }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Pengajuan Tugas Akhir</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-tugasakhir-anggota/' . $value->id_ta) }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                                <textarea id="nama_mahasiswa" 
                                          class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                          name="nama_mahasiswa" 
                                          required autofocus>{{ old('nama_mahasiswa', $value->nama_mahasiswa) }}</textarea>
                                @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang menjadi penulis tugas akhir dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Tugas Akhir') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ $value->judul }}" required autofocus>
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
                                    value="{{ $value->bentuk }}" required autofocus>
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
    @endforeach

    @foreach ($poster as $no => $value)
        <div class="modal" id="UbahPoster{{ $value->id_poster }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Pengajuan Poster</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-poster-anggota/' . $value->id_poster) }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                @if ($value->foto)
                                    <img src="{{ asset('image/poster/' . $value->foto) }}" alt="Foto Poster"
                                        style="width: 100px; margin-bottom: 10px;">
                                @endif
                                <label for="foto" class="required-label">{{ __('Foto Poster') }}</label>
                                <input id="foto" onchange="readFoto(event)" type="file"
                                    class="form-control @error('foto') is-invalid @enderror" name="foto"
                                    value="{{ old('foto') }}" autofocus>
                                <img id="output" style="width: 100px;">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                                <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                    name="nama_mahasiswa" required autofocus>{{ old('nama_mahasiswa', $value->nama_mahasiswa) }}</textarea>
                                @error('nama_mahasiswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa
                                    yang menjadi pencipta poster dengan memisahkannya menggunakan enter tanpa pejudulan.</p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Poster') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ $value->judul }}" required autofocus>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="jenis" class="required-label">{{ __('Jenis Poster') }}</label>
                                <input id="jenis" type="text"
                                    class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" value="{{ $value->jenis }}" required autofocus>
                                @error('jenis')
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
    @endforeach

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
