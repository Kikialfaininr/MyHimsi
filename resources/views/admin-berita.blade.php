@extends('layouts.app')

@section('content')
    <div class="dataCard">
        <h2>Data Berita</h2>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahDataBerita"
                        title="Tambah Data">
                        <i class='bx bx-plus'></i> Tambah Data Berita
                    </button>
                    <a href="{{ url('downloadpdf-berita') }}" target="_blank">
                        <button class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Cetak
                        </button>
                    </a>
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
                            <th class="text-center">Foto Berita</th>
                            <th class="text-center">Penulis</th>
                            <th class="text-center">Judul Berita</th>
                            <th class="text-center">Isi Berita</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berita as $no => $value)
                            <tr>
                                <td class="text-center">{{ $no + 1 }}</td>
                                <td class="text-center">
                                    @if ($value->foto)
                                        <img src="image/berita/{{ $value->foto }}" alt="profil"
                                            style="width:100px; height: 100px;"
                                            class="d-inline-block align-text-center rounded-circle" />
                                    @else
                                        <img src="image/berita.png" alt="profil" style="width:100px; height: 100px;"
                                            class="d-inline-block align-text-center rounded-circle">
                                    @endif
                                </td> 
                                <td>{{ $value->penulis }}</td>                              
                                <td>{{ $value->judul_berita }}</td>
                                <td>{{ $value->deskripsi }}</td>
                                <td class="action-col">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UbahBerita{{ $value->id_berita }}" title="Ubah Data">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <a href="{{ url($value->id_berita . '/hapus-berita') }}">
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
    <div class="modal" id="TambahDataBerita" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Berita</h4>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('simpan-data-berita') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="foto">{{ __('Foto Berita') }}</label>
                            <input id="foto" onchange="readFoto(berita)" type="file"
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
                            <label for="penulis" class="required-label">{{ __('Penulis') }}</label>
                            <input id="penulis" type="text"
                                class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                                value="{{ old('penulis') }}">
                            @error('penulis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="judul_berita" class="required-label">{{ __('Judul Berita') }}</label>
                            <input id="judul_berita" type="text"
                                class="form-control @error('judul_berita') is-invalid @enderror" name="judul_berita"
                                value="{{ old('judul_berita') }}" required autofocus>
                            @error('judul_berita')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="deskripsi" class="required-label">{{ __('Isi Berita') }}</label>
                            <input id="deskripsi" type="text"
                                class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                value="{{ old('deskripsi') }}">
                            @error('deskripsi')
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
    @foreach ($berita as $no => $value)
        <div class="modal" id="UbahBerita{{ $value->id_berita }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data berita</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-berita/' . $value->id_berita) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="foto">{{ __('Foto Berita') }}</label>
                                @if ($value->foto)
                                    <img src="{{ asset('image/berita/' . $value->foto) }}" alt="Foto Produk"
                                        style="width: 100px;">
                                @endif

                                <input id="foto" onchange="readFoto(berita)" type="file"
                                    class="form-control @error('foto') is-invalid @enderror" name="foto" autofocus>
                                <img id="output" style="width: 100px; display: none;">

                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="penulis" class="required-label">{{ __('Penulis') }}</label>
                                <input id="penulis" type="text"
                                    class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                                    value="{{ $value->penulis }}">
                                @error('penulis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="judul_berita" class="required-label">{{ __('Judul berita') }}</label>
                                <input id="judul_berita" type="text"
                                    class="form-control @error('judul_berita') is-invalid @enderror" name="judul_berita"
                                    value="{{ $value->judul_berita }}" required autofocus>
                                @error('judul_berita')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="deskripsi" class="required-label">{{ __('Isi Berita') }}</label>
                                <input id="deskripsi" type="text"
                                    class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                    value="{{ $value->deskripsi }}">
                                @error('deskripsi')
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    {{-- password --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = document.querySelector('#icon');

        togglePassword.addberitaListener('click', function(e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye / eye-slash icon
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
    {{-- foto --}}
    <script>
        function readFoto(berita) {
            var input = berita.target;
            var output = document.getElementById('output');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    output.src = e.target.result;
                    output.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                output.src = '';
                output.style.display = 'none';
            }
        }
    </script>
@endsection
