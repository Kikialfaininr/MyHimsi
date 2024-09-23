@extends('layouts.app')

@section('content')
    <div class="dataCard">
        <h2>Data Anggota</h2>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahDataAnggota"
                        title="Tambah Data">
                        <i class='bx bx-plus'></i> Tambah Data Anggota
                    </button>
                    <a href="{{ url('downloadpdf-anggota') }}" target="_blank">
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
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Angkatan</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Link Instagram</th>
                            <th class="text-center">Link Linkedin</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $no => $value)
                            <tr>
                                <td class="text-center">{{ $no + 1 }}</td>
                                <td class="text-center">
                                    @if ($value->foto)
                                        <a href="{{ asset('image/anggota/' . $value->foto) }}" target="_blank">
                                            <img src="{{ asset('image/anggota/' . $value->foto) }}" alt="profil" style="width:100px; height: 100px;" class="d-inline-block align-text-center rounded-circle table-img" />
                                        </a>
                                    @else
                                        <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                            <img src="{{ asset('image/profil.jpg') }}" alt="profil" style="width:100px; height: 100px;" class="d-inline-block align-text-center rounded-circle table-img">
                                        </a>
                                    @endif
                                </td>                                
                                <td>{{ $value->full_name }}</td>
                                <td class="text-center">{{ $value->nim }}</td>
                                <td class="text-center">{{ $value->angkatan }}</td>
                                <td class="text-center">{{ $value->jenis_kelamin }}</td>
                                <td>{{ $value->divisi->nama_divisi }}</td>
                                <td>{{ $value->jabatan->nama_jabatan }}</td>
                                <td>
                                    <a href="{{ $value->link_ig }}" target="_blank">{{ $value->link_ig }}</a>
                                </td> 
                                <td>
                                    <a href="{{ $value->link_linkedin }}" target="_blank">{{ $value->link_linkedin }}</a>
                                </td> 
                                <td class="action-col">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UbahAnggota{{ $value->id_anggota }}" title="Ubah Data">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <a href="{{ url($value->id_anggota . '/hapus-anggota') }}">
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

        {{-- tambah data --}}
        <div class="modal" id="TambahDataAnggota" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Anggota</h4>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('simpan-data-anggota') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="foto">{{ __('Foto Profil') }}</label>
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
                                <label for="full_name" class="required-label">{{ __('Nama Lengkap') }}</label>
                                <input id="full_name" type="text"
                                    class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                    value="{{ old('full_name') }}" required autofocus>
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="nim" class="required-label">{{ __('NIM') }}</label>
                                <input id="nim" type="number" class="form-control @error('nim') is-invalid @enderror"
                                    name="nim" value="{{ old('nim') }}" required autofocus>
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="angkatan" class="required-label">{{ __('Angkatan') }}</label>
                                <select id="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                                    name="angkatan" required autofocus>
                                    <option value="">Pilih Tahun</option>
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = 2019;
                                    @endphp
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('angkatan') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('angkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="required-label">{{ __('Jenis Kelamin') }}</label>
                                <div class="form-check">
                                    <input id="jenis_kelamin_laki" type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" value="Laki-laki"
                                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                                    <label for="jenis_kelamin_laki"
                                        class="form-check-label">{{ __('Laki-laki') }}</label>
                                </div>
                                <div class="form-check">
                                    <input id="jenis_kelamin_perempuan" type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" value="Perempuan"
                                        {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                    <label for="jenis_kelamin_perempuan"
                                        class="form-check-label">{{ __('Perempuan') }}</label>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="id_divisi" class="required-label">{{ __('Divisi') }}</label>
                                <select class="form-select" name="id_divisi" id="id_divisi"
                                    value="{{ $value->id_divisi }}" style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                                    <option disble value>Pilih Divisi</option>
                                    @foreach ($divisi as $data)
                                        <option value="{{ $data->id_divisi }}"
                                            {{ $value && $data->id_divisi == $value->id_divisi ? 'selected' : '' }}>
                                            {{ $data->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="id_jabatan" class="required-label">{{ __('Jabatan') }}</label>
                                <select class="form-select" name="id_jabatan" id="id_jabatan"
                                    value="{{ $value->id_jabatan }}" style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                                    <option disble value>Pilih Jabatan</option>
                                    @foreach ($jabatan as $data)
                                        <option value="{{ $data->id_jabatan }}"
                                            {{ $value && $data->id_jabatan == $value->id_jabatan ? 'selected' : '' }}>
                                            {{ $data->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="link_ig">{{ __('Link Instagram') }}</label>
                                <input id="link_ig" type="text"
                                    class="form-control @error('link_ig') is-invalid @enderror" name="link_ig"
                                    value="{{ old('link_ig') }}">
                                @error('link_ig')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="link_linkedin">{{ __('Link Linkedin') }}</label>
                                <input id="link_linkedin" type="text"
                                    class="form-control @error('link_linkedin') is-invalid @enderror" name="link_linkedin"
                                    value="{{ old('link_linkedin') }}">
                                @error('link_linkedin')
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
        @foreach ($anggota as $no => $value)
            <div class="modal" id="UbahAnggota{{ $value->id_anggota }}" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Anggota</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ url('update-anggota/' . $value->id_anggota) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="foto">{{ __('Foto Profil') }}</label><br>
                                    @if ($value->foto)
                                        <img src="{{ asset('image/anggota/' . $value->foto) }}" alt="Foto Profil" style="width: 100px;">
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
                                    <label for="full_name" class="required-label">{{ __('Nama Lengkap') }}</label>
                                    <input id="full_name" type="text"
                                        class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                        value="{{ $value->full_name }}" required autofocus>
                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="nim" class="required-label">{{ __('NIM') }}</label>
                                    <input id="nim" type="number"
                                        class="form-control @error('nim') is-invalid @enderror" name="nim"
                                        value="{{ $value->nim }}" required autofocus>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="angkatan" class="required-label">{{ __('Angkatan') }}</label>
                                    <select id="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                                        name="angkatan" required autofocus>
                                        <option value="">Pilih Tahun</option>
                                        @php
                                            $currentYear = date('Y');
                                            $startYear = 2019;
                                        @endphp
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}"
                                                {{ ($value->angkatan ?? old('angkatan')) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('angkatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="required-label">{{ __('Jenis Kelamin') }}</label>
                                    <div class="form-check">
                                        <input id="jenis_kelamin_laki" type="radio"
                                            class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                            name="jenis_kelamin" value="Laki-laki"
                                            {{ ($value->jenis_kelamin ?? old('jenis_kelamin')) == 'Laki-laki' ? 'checked' : '' }}
                                            required>
                                        <label for="jenis_kelamin_laki"
                                            class="form-check-label">{{ __('Laki-laki') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="jenis_kelamin_perempuan" type="radio"
                                            class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                            name="jenis_kelamin" value="Perempuan"
                                            {{ ($value->jenis_kelamin ?? old('jenis_kelamin')) == 'Perempuan' ? 'checked' : '' }}
                                            required>
                                        <label for="jenis_kelamin_perempuan"
                                            class="form-check-label">{{ __('Perempuan') }}</label>
                                    </div>
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="id_divisi" class="required-label">{{ __('Divisi') }}</label>
                                    <select class="form-select" name="id_divisi" id="id_divisi"
                                        style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                                        <option value="">Pilih Divisi</option>
                                        @foreach ($divisi as $data)
                                            <option value="{{ $data->id_divisi }}"
                                                {{ ($value->id_divisi ?? old('id_divisi')) == $data->id_divisi ? 'selected' : '' }}>
                                                {{ $data->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="id_jabatan" class="required-label">{{ __('Jabatan') }}</label>
                                    <select class="form-select" name="id_jabatan" id="id_jabatan"
                                        style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($jabatan as $data)
                                            <option value="{{ $data->id_jabatan }}"
                                                {{ ($value->id_jabatan ?? old('id_jabatan')) == $data->id_jabatan ? 'selected' : '' }}>
                                                {{ $data->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="link_ig">{{ __('Link Instagram') }}</label>
                                    <input id="link_ig" type="text"
                                        class="form-control @error('link_ig') is-invalid @enderror" name="link_ig"
                                        value="{{ $value->link_ig }}">
                                    @error('link_ig')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="link_linkedin">{{ __('Link Linkedin') }}</label>
                                    <input id="link_linkedin" type="text"
                                        class="form-control @error('link_linkedin') is-invalid @enderror"
                                        name="link_linkedin" value="{{ $value->link_linkedin }}">
                                    @error('link_linkedin')
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
