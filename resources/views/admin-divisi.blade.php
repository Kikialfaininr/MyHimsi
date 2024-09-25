@extends('layouts.app')

@section('content')
<div class="dataCard">
    <h2>Data Divisi</h2>
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
                    data-bs-toggle="modal" data-bs-target="#TambahDataDivisi" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Divisi
                </button>
                <a href="{{url('downloadpdf-divisi')}}" target="_blank">
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
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($divisi as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->nama_divisi}}</td>
                        <td>{{$value->deskripsi}}</td>
                        <td>{{$value->periode->periode}}</td>
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahDivisi{{$value->id_divisi}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id_divisi.'/hapus-divisi')}}">
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
<div class="modal" id="TambahDataDivisi" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Divisi</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-divisi')}}">
                    @csrf
                    <div>
                        <label for="nama_divisi" class="required-label">{{ __('Divisi') }}</label>
                        <input id="nama_divisi" type="text"
                            class="form-control @error('nama_divisi') is-invalid @enderror" name="nama_divisi"
                            value="{{ old('nama_divisi') }}" required autofocus>
                        @error('nama_divisi')
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
                        <label for="id_periode" class="required-label">{{ __('Periode') }}</label>
                        <select class="form-select" name="id_periode" id="id_periode"
                            value="{{ $value->id_periode }}" style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                            <option disble value>Pilih periode</option>
                            @foreach ($periode as $data)
                                <option value="{{ $data->id_periode }}"
                                    {{ $value && $data->id_periode == $value->id_periode ? 'selected' : '' }}>
                                    {{ $data->periode }}</option>
                            @endforeach
                        </select>
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
@foreach($divisi as $no => $value)
<div class="modal" id="UbahDivisi{{$value->id_divisi}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Divisi</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-divisi/'.$value->id_divisi)}}">
                    @csrf
                    <div>
                        <label for="nama_divisi" class="required-label">{{ __('Divisi') }}</label>
                        <input id="nama_divisi" type="text"
                            class="form-control @error('nama_divisi') is-invalid @enderror" name="nama_divisi"
                            value="{{ $value->nama_divisi }}" required autofocus>
                        @error('nama_divisi')
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
                        <label for="id_periode" class="required-label">{{ __('Periode') }}</label>
                        <select class="form-select" name="id_periode" id="id_periode"
                            style="width: 100%; height: 35px; font-size: 13px;" required autofocus>
                            <option value="">Pilih periode</option>
                            @foreach ($periode as $data)
                                <option value="{{ $data->id_periode }}"
                                    {{ ($value->id_periode ?? old('id_periode')) == $data->id_periode ? 'selected' : '' }}>
                                    {{ $data->periode }}
                                </option>
                            @endforeach
                        </select>
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
