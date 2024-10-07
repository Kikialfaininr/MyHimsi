@extends('layouts.app')

@section('title', 'Data Poster')

@section('content')
    <div class="dataCard">
        <h2>Data Galeri Poster Mahasiswa</h2>
        <div class="col-md-12 col-xs-12">
            {{-- alert --}}
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
            <div class="row">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahDataPoster"
                        title="Tambah Data">
                        <i class='bx bx-plus'></i> Tambah Data Poster
                    </button>
                </div>
            </div>
        </div>
        {{-- tabel data --}}
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table table-responsive table-striped table-hover table-bordered">
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
                                    @if (is_null($value->status))
                                        <button class="btn btn-success btn-sm"
                                            onclick="confirmStatus('Terima', '{{ url('status-poster/' . $value->id_poster) }}')"><i
                                                class='bx bx-check'></i></button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmStatus('Tolak', '{{ url('status-poster/' . $value->id_poster) }}')"><i
                                                class='bx bx-x'></i></button>
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
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UbahPoster{{ $value->id_poster }}" title="Ubah Data">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <a href="{{ url($value->id_poster . '/hapus-poster') }}">
                                        <button title="Hapus Data" class="btn btn-danger btn-sm">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- tambah data --}}
    <div class="modal" id="TambahDataPoster" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Poster</h4>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('simpan-data-poster') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="foto" class="required-label">{{ __('Foto Poster') }}</label>
                            <input id="foto" onchange="readFoto(event)" type="file"
                                class="form-control @error('foto') is-invalid @enderror" name="foto"
                                value="{{ old('foto') }}" required autofocus>
                            <img id="output" style="width: 100px;">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                            <textarea id="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa"
                                value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                            @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang
                                menjadi pencipta poster dengan memisahkannya menggunakan enter tanpa pejudulan.</p>
                        </div>
                        <div>
                            <label for="judul" class="required-label">{{ __('Judul Poster') }}</label>
                            <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" value="{{ old('judul') }}" required autofocus>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="jenis" class="required-label">{{ __('Jenis Poster') }}</label>
                            <input id="jenis" type="text"
                                class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                                value="{{ old('jenis') }}" required autofocus>
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

    {{-- edit data --}}
    @foreach ($poster as $no => $value)
        <div class="modal" id="UbahPoster{{ $value->id_poster }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Poster</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-poster/' . $value->id_poster) }}" enctype="multipart/form-data">
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
                $('#example').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
            });
        </script>
    @endpush

    <script>
        function confirmStatus(action, url) {
            let textMessage = action === 'Terima' ? 'Terima pengajuan poster mahasiswa?' :
                'Tolak pengajuan poster mahasiswa?';
            Swal.fire({
                title: textMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, ' + action,
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';

                    let csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);

                    let statusField = document.createElement('input');
                    statusField.type = 'hidden';
                    statusField.name = 'status';
                    statusField.value = action === 'Terima' ? 'Diterima' : 'Ditolak';
                    form.appendChild(statusField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
    <script>
        function readFoto(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        }
    </script>
@endsection
