@extends('layouts.app-general')

@section('content')
    <div class="profil">
        <div class="row">
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
            <div class="col-md-4">
                <div class="userData">
                    <div class="card">
                        @foreach ($anggota as $no => $value)
                        <div class="profil-img">
                            @if ($value->foto)
                                <a href="{{ asset('image/anggota/' . $value->foto) }}" target="_blank">
                                    <img src="{{ asset('image/anggota/' . $value->foto) }}" alt="profil" class="d-inline-block align-text-center" />
                                </a>
                            @else
                                <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                    <img src="{{ asset('image/profil.jpg') }}" alt="profil" class="d-inline-block align-text-center">
                                </a>
                            @endif
                            <button type="button" class="btn btn-primary img-btn" data-bs-toggle="modal" data-bs-target="#EditFoto{{ $value->id_anggota }}" title="Edit Foto Profil">
                                <i class='bx bxs-edit'></i> edit image
                            </button>
                        </div>                        
                        @endforeach
                        @foreach($users as $no => $value)
                        <div class="profil-data">
                            <h2>{{$value->name}}</h2>
                            <h3>{{$value->email}}</h3>
                            <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal"
                                data-bs-target="#EditLogin{{ $value->id }}" title="Edit Data User">
                                <i class='bx bxs-edit'></i> edit data login
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="memberData">
                    <div class="card">
                        <h2>Profil Anggota</h2>
                        @foreach ($anggota as $no => $value)
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{$value->full_name}}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{$value->nim}}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>:</td>
                                    <td>{{$value->angkatan}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{$value->jenis_kelamin}}</td>
                                </tr>
                                <tr>
                                    <td>Link Linkedin</td>
                                    <td>:</td>
                                    <td><a href="{{ $value->link_linkedin }}" target="_blank">{{ $value->link_linkedin }}</a></td>
                                </tr>
                                <tr>
                                    <td>Link Instagram</td>
                                    <td>:</td>
                                    <td><a href="{{ $value->link_ig }}" target="_blank">{{ $value->link_ig }}</a></td>
                                </tr>
                                <tr>
                                    <td>Divisi</td>
                                    <td>:</td>
                                    <td>{{$value->divisi->nama_divisi}}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>{{$value->jabatan->nama_jabatan}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal"
                                data-bs-target="#EditData{{ $value->id_anggota }}" title="Edit Data Member">
                                <i class='bx bxs-edit'></i> edit data member
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- edit foto profil --}}
@foreach ($anggota as $no => $value)
 <div class="modal" id="EditFoto{{ $value->id_anggota }}" role="dialog">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Ubah Foto Profil</h4>
             </div>
             <div class="modal-body">
                 <form method="POST" action="{{ url('ubah-profil/' . $value->id_anggota) }}"
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

{{-- edit data login --}}
@foreach($users as $no => $value)
<div class="modal" id="EditLogin{{$value->id}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('ubah-login/'.$value->id)}}">
                    @csrf
                    <div>
                        <label for="id_anggota" class="required-label">{{ __('Nama Anggota') }}</label>
                        <select class="form-select @error('id_anggota') is-invalid @enderror" name="id_anggota" id="id_anggota" style="width: 100%; height: 35px; font-size: 13px;" required>
                            <option value="">Pilih nama anggota</option>
                            @foreach ($anggota as $data)
                                <option value="{{ $data->id_anggota }}" {{ $value->id_anggota == $data->id_anggota ? 'selected' : '' }}>
                                    {{ $data->full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_anggota')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>                    
                    <div>
                        <label for="name" class="required-label">{{ __('Username') }}</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $value->name }}" required autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $value->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password">{{ __('Password') }}</label>
                        <div class="password-wrapper">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukkan password baru (jika ingin mengubah)"
                                autocomplete="new-password">
                            <span class="password-toggle" onclick="togglePassword()">
                                <i id="password-icon" class='bx bx-hide'></i>
                            </span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                            placeholder="Konfirmasi password baru (jika diubah)"
                            autocomplete="new-password">
                        @error('password_confirmation')
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

 {{-- edit data anggota --}}
 @foreach ($anggota as $no => $value)
 <div class="modal" id="EditData{{ $value->id_anggota }}" role="dialog">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Ubah Data Anggota</h4>
             </div>
             <div class="modal-body">
                 <form method="POST" action="{{ url('ubah-anggota/' . $value->id_anggota) }}">
                     @csrf
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

{{-- password --}}
<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordIcon = document.getElementById('password-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('bx-hide');
            passwordIcon.classList.add('bx-show');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('bx-show');
            passwordIcon.classList.add('bx-hide');
        }
    }
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

