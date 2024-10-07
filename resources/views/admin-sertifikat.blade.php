@extends('layouts.app')

@section('title', 'Data Sertifikat')

@section('content')
<div class="dataCard">
    <h2>Data Sertifikat</h2>
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
                    data-bs-toggle="modal" data-bs-target="#TambahDataSertifikat" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Sertifikat
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
                        <th class="text-center">Sertifikat</th>
                        <th class="text-center">Link Sertifikat</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sertifikat as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->nama_sertifikat}}</td>
                        <td>
                            <a href="{{ $value->link_sertifikat }}" target="_blank">{{ $value->link_sertifikat }}</a>
                        </td>
                        <td>{{$value->kategori}}</td>                    
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahSertifikat{{$value->id_sertifikat}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id_sertifikat.'/hapus-sertifikat')}}">
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
<div class="modal" id="TambahDataSertifikat" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Sertifikat</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-sertifikat')}}">
                    @csrf
                    <div>
                        <label for="nama_sertifikat" class="required-label">{{ __('Nama Sertifikat') }}</label>
                        <input id="nama_sertifikat" type="text"
                            class="form-control @error('nama_sertifikat') is-invalid @enderror" name="nama_sertifikat"
                            value="{{ old('nama_sertifikat') }}" required autofocus>
                        @error('nama_sertifikat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="link_sertifikat" class="required-label">{{ __('Link Sertifikat') }}</label>
                        <input id="link_sertifikat" type="text"
                            class="form-control @error('link_sertifikat') is-invalid @enderror" name="link_sertifikat"
                            value="{{ old('link_sertifikat') }}" required autofocus>
                        @error('link_sertifikat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="kategori" class="required-label">{{ __('Kategori') }}</label>
                        <select id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" required autofocus>
                            <option value="" selected disabled>Pilih kategori</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Umum">Umum</option>
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
@foreach($sertifikat as $no => $value)
<div class="modal" id="UbahSertifikat{{$value->id_sertifikat}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Sertifikat</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-sertifikat/'.$value->id_sertifikat)}}">
                    @csrf
                    <div>
                        <label for="nama_sertifikat" class="required-label">{{ __('Nama Sertifikat') }}</label>
                        <input id="nama_sertifikat" type="text"
                            class="form-control @error('nama_sertifikat') is-invalid @enderror" name="nama_sertifikat"
                            value="{{ $value->nama_sertifikat }}" required autofocus>
                        @error('nama_sertifikat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="link_sertifikat" class="required-label">{{ __('Link Sertifikat') }}</label>
                        <input id="link_sertifikat" type="text"
                            class="form-control @error('link_sertifikat') is-invalid @enderror" name="link_sertifikat"
                            value="{{ $value->link_sertifikat }}" required autofocus>
                        @error('link_sertifikat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="kategori" class="required-label">{{ __('Kategori') }}</label>
                        <select id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" required autofocus>
                            <option value="Anggota" {{ $value->kategori == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="Umum" {{ $value->kategori == 'Umum' ? 'selected' : '' }}>Umum</option>
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
@endsection
