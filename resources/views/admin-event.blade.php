@extends('layouts.app')

@section('title', 'Data Event')

@section('content')
    <div class="dataCard">
        <h2>Data Event</h2>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahDataEvent"
                        title="Tambah Data">
                        <i class='bx bx-plus'></i> Tambah Data Event
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
                            <th class="text-center">Foto</th>
                            <th class="text-center">Event</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Waktu Mulai</th>
                            <th class="text-center">Waktu Selesai</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Penyelenggara</th>
                            <th class="text-center">Link Kegiatan</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $no => $value)
                            <tr>
                                <td class="text-center">{{ $no + 1 }}</td>
                                <td class="text-center">
                                    @if ($value->foto)
                                        <a href="{{ asset('image/event/' . $value->foto) }}" target="_blank">
                                            <img src="{{ asset('image/event/' . $value->foto) }}" alt="event"
                                                style="width:100px; height: 100px;"
                                                class="d-inline-block align-text-center" />
                                        </a>
                                    @else
                                        @if ($value->kategori == "Acara")
                                            <a href="{{ asset('image/acara.png') }}" target="_blank">
                                                <img src="{{ asset('image/acara.png') }}" alt="acara"
                                                    style="width:100px; height: 100px;"
                                                    class="d-inline-block align-text-center" />
                                            </a>
                                        @elseif ($value->kategori == "Akademik")
                                            <a href="{{ asset('image/akademik.png') }}" target="_blank">
                                                <img src="{{ asset('image/akademik.png') }}" alt="akademik"
                                                    style="width:100px; height: 100px;"
                                                    class="d-inline-block align-text-center" />
                                            </a>
                                        @elseif ($value->kategori == "Rapat")
                                            <a href="{{ asset('image/rapat.png') }}" target="_blank">
                                                <img src="{{ asset('image/rapat.png') }}" alt="rapat"
                                                    style="width:100px; height: 100px;"
                                                    class="d-inline-block align-text-center" />
                                            </a>
                                        @else
                                            <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                                <img src="{{ asset('image/profil.jpg') }}" alt="profil"
                                                    style="width:100px; height: 100px;"
                                                    class="d-inline-block align-text-center" />
                                            </a>
                                        @endif
                                    @endif
                                </td>                                 
                                <td>{{ $value->nama_event }}</td>                              
                                <td>{{ \Carbon\Carbon::parse($value->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $value->waktu_mulai }}</td>
                                <td>{{ $value->waktu_selesai }}</td>
                                <td>{{ $value->lokasi }}</td>
                                <td>{{ $value->penyelenggara }}</td>
                                <td>
                                    <a href="{{ $value->link_kegiatan }}" target="_blank">{{ $value->link_kegiatan }}</a>
                                </td> 
                                <td>{{ $value->deskripsi }}</td>
                                <td>{{ $value->kategori }}</td>
                                <td class="action-col">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UbahEvent{{ $value->id_event }}" title="Ubah Data">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <a href="{{ url($value->id_event . '/hapus-event') }}">
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
    <div class="modal" id="TambahDataEvent" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Event</h4>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('simpan-data-event') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="foto">{{ __('Foto Event') }}</label>
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
                            <label for="nama_event" class="required-label">{{ __('Nama Event') }}</label>
                            <input id="nama_event" type="text"
                                class="form-control @error('nama_event') is-invalid @enderror" name="nama_event"
                                value="{{ old('nama_event') }}" required autofocus>
                            @error('nama_event')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggal" class="required-label">{{ __('Tanggal') }}</label>
                            <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                name="tanggal" value="{{ old('tanggal') }}" required autofocus>
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="waktu_mulai">{{ __('Waktu Mulai') }}</label>
                            <input id="waktu_mulai" type="time"
                                class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai"
                                value="{{ old('waktu_mulai') }}">
                            @error('waktu_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="waktu_selesai">{{ __('Waktu Selesai') }}</label>
                            <input id="waktu_selesai" type="time"
                                class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai"
                                value="{{ old('waktu_selesai') }}">
                            @error('waktu_selesai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="lokasi">{{ __('Lokasi') }}</label>
                            <input id="lokasi" type="text"
                                class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="penyelenggara" class="required-label">{{ __('Penyelenggara') }}</label>
                            <input id="penyelenggara" type="text"
                                class="form-control @error('penyelenggara') is-invalid @enderror" name="penyelenggara"
                                value="{{ old('penyelenggara') }}" required autofocus>
                            @error('penyelenggara')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="link_kegiatan">{{ __('Link Kegiatan') }}</label>
                            <input id="link_kegiatan" type="text"
                                class="form-control @error('link_kegiatan') is-invalid @enderror" name="link_kegiatan"
                                value="{{ old('link_kegiatan') }}">
                            @error('link_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="deskripsi" class="required-label">{{ __('Deskripsi') }}</label>
                            <input id="deskripsi" type="text"
                                class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                value="{{ old('deskripsi') }}" required autofocus>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="kategori" class="required-label">{{ __('Kategori') }}</label>
                            <select id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" required autofocus>
                                <option value="" selected disabled>Pilih kategori</option>
                                <option value="Acara">Acara</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Rapat">Rapat</option>
                            </select>
                            @error('kategori')
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
    @foreach ($event as $no => $value)
        <div class="modal" id="UbahEvent{{ $value->id_event }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Event</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-event/' . $value->id_event) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="foto">{{ __('Foto Event') }}</label><br>
                                @if ($value->foto)
                                    <img src="{{ asset('image/event/' . $value->foto) }}" alt="Foto Event" style="width: 100px;">
                                    <div>
                                        <input type="checkbox" name="hapus_foto" id="hapus_foto">
                                        <label for="hapus_foto">Hapus Foto</label>
                                    </div>
                                @endif
                            
                                <input id="foto" onchange="readFoto(event)" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" autofocus>
                                <img id="output" style="width: 100px; display: none;">
                            
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="nama_event" class="required-label">{{ __('Nama Event') }}</label>
                                <input id="nama_event" type="text"
                                    class="form-control @error('nama_event') is-invalid @enderror" name="nama_event"
                                    value="{{ $value->nama_event }}" required autofocus>
                                @error('nama_event')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal" class="required-label">{{ __('Tanggal') }}</label>
                                <input id="tanggal" type="date"
                                    class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                    value="{{ old('tanggal', $value->tanggal) }}" required autofocus>
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div> 
                                <label for="waktu_mulai">{{ __('Waktu Mulai') }}</label>
                                <input id="waktu_mulai" type="time"
                                    class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai"
                                    value="{{ old('waktu_mulai', $value->waktu_mulai) }}">
                                @error('waktu_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="waktu_selesai">{{ __('Waktu Selesai') }}</label>
                                <input id="waktu_selesai" type="time"
                                    class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai"
                                    value="{{ old('waktu_selesai', $value->waktu_selesai) }}">
                                @error('waktu_selesai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="lokasi">{{ __('Lokasi') }}</label>
                                <input id="lokasi" type="text"
                                    class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                    value="{{ $value->lokasi }}">
                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="penyelenggara" class="required-label">{{ __('Penyelenggara') }}</label>
                                <input id="penyelenggara" type="text"
                                    class="form-control @error('penyelenggara') is-invalid @enderror" name="penyelenggara"
                                    value="{{ $value->penyelenggara }}" required autofocus>
                                @error('penyelenggara')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="link_kegiatan">{{ __('Link Kegiatan') }}</label>
                                <input id="link_kegiatan" type="text"
                                    class="form-control @error('link_kegiatan') is-invalid @enderror" name="link_kegiatan"
                                    value="{{ $value->link_kegiatan }}">
                                @error('link_kegiatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="deskripsi" class="required-label">{{ __('Deskripsi') }}</label>
                                <input id="deskripsi" type="text"
                                    class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                    value="{{ $value->deskripsi }}" required autofocus>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="kategori" class="required-label">{{ __('Kategori') }}</label>
                                <select id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" required autofocus>
                                    <option value="Acara" {{ $value->kategori == 'Acara' ? 'selected' : '' }}>Acara</option>
                                    <option value="Akademik" {{ $value->kategori == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="Rapat" {{ $value->kategori == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                                </select>
                                @error('kategori')
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
    {{-- password --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = document.querySelector('#icon');

        togglePassword.addEventListener('click', function(e) {
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
        function readFoto(event) {
            var input = event.target;
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
