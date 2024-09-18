@extends('layouts.app')

@section('content')
<div class="dataCard">
    <h2>Data Login Anggota</h2>
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
                <button type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#TambahDataLogin" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Login
                </button>
                <a href="{{url('downloadpdf-users')}}" target="_blank">
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
                        <th class="text-center">Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Password</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->anggota->full_name}}</td>
                        <td>{{$value->name}}</td> 
                        <td>{{$value->email}}</td> 
                        <td>{{$value->password}}</td>                    
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahLogin{{$value->id}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id.'/hapus-users')}}">
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
<div class="modal" id="TambahDataLogin" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Login</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-users')}}">
                    @csrf
                    <div>
                        <label for="id_anggota" class="required-label">{{ __('Nama Anggota') }}</label>
                        <select class="form-select" name="id_anggota" id="id_anggota"
                            style="width: 100%; height: 35px; font-size: 13px;" required>
                            <option value="">Pilih nama anggota</option>
                            @foreach ($anggota as $data)
                                <option value="{{ $data->id_anggota }}">
                                    {{ $data->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>                    
                    <div>
                        <label for="name" class="required-label">{{ __('Username') }}</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            required autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="required-label">{{ __('Password') }}</label>
                        <div class="password-wrapper">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autofocus>
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
                        <label for="password_confirmation" class="required-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                            required autofocus>
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



{{-- edit data --}}
@foreach($users as $no => $value)
<div class="modal" id="UbahLogin{{$value->id}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-users/'.$value->id)}}">
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
                        <label for="name" class="required-label">{{ __('Link login') }}</label>
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
                        <label for="password" class="required-label">{{ __('Password') }}</label>
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
                        <label for="password_confirmation" class="required-label">{{ __('Confirm Password') }}</label>
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
    
@endpush
@endsection
