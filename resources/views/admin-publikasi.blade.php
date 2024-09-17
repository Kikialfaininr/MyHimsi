@extends('layouts.app')

@section('content')
<div class="dataCard">
    <h2>Data Publikasi Jurnal</h2>
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
                    data-bs-toggle="modal" data-bs-target="#TambahDataPublikasi" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Publikasi
                </button>
                <a href="{{url('downloadpdf-publikasi')}}" target="_blank">
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
                        <th class="text-center">Jurnal</th>
                        <th class="text-center">Indeks</th>
                        <th class="text-center">Waktu Terbit</th>
                        <th class="text-center">Bidang</th>
                        <th class="text-center">Biaya</th>
                        <th class="text-center">Link Jurnal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publikasi as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->nama_jurnal}}</td>
                        <td>{{$value->indeks}}</td>
                        <td>{{$value->waktu_terbit}}</td>
                        <td>{{$value->bidang}}</td>
                        <td>Rp {{ number_format($value->biaya) }}</td>
                        <td>
                            <a href="{{ $value->link_jurnal }}" target="_blank">{{ $value->link_jurnal }}</a>
                        </td>                        
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahPublikasi{{$value->id_publikasi}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id_publikasi.'/hapus-publikasi')}}">
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
<div class="modal" id="TambahDataPublikasi" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Publikasi</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-publikasi')}}">
                    @csrf
                    <div>
                        <label for="nama_jurnal" class="required-label">{{ __('Nama Jurnal') }}</label>
                        <input id="nama_jurnal" type="text"
                            class="form-control @error('nama_jurnal') is-invalid @enderror" name="nama_jurnal"
                            value="{{ old('nama_jurnal') }}" required autofocus>
                        @error('nama_jurnal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="indeks" class="required-label">{{ __('Indeks') }}</label>
                        <input id="indeks" type="text"
                            class="form-control @error('indeks') is-invalid @enderror" name="indeks"
                            value="{{ old('indeks') }}" required autofocus>
                        @error('indeks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="waktu_terbit" class="required-label">{{ __('Waktu Terbit') }}</label>
                        <input id="waktu_terbit" type="text"
                            class="form-control @error('waktu_terbit') is-invalid @enderror" name="waktu_terbit"
                            value="{{ old('waktu_terbit') }}" required autofocus>
                        @error('waktu_terbit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="bidang" class="required-label">{{ __('Bidang') }}</label>
                        <input id="bidang" type="text"
                            class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                            value="{{ old('bidang') }}" required autofocus>
                        @error('bidang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="biaya" class="required-label">{{ __('Biaya') }}</label>
                        <input id="biaya" type="number"
                            class="form-control @error('biaya') is-invalid @enderror" name="biaya"
                            value="{{ old('biaya') }}" required autofocus>
                        @error('biaya')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="link_jurnal" class="required-label">{{ __('Link Jurnal') }}</label>
                        <input id="link_jurnal" type="text"
                            class="form-control @error('link_jurnal') is-invalid @enderror" name="link_jurnal"
                            value="{{ old('link_jurnal') }}" required autofocus>
                        @error('link_jurnal')
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
@foreach($publikasi as $no => $value)
<div class="modal" id="UbahPublikasi{{$value->id_publikasi}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data publikasi</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-publikasi/'.$value->id_publikasi)}}">
                    @csrf
                    <div>
                        <label for="nama_jurnal" class="required-label">{{ __('Nama Jurnal') }}</label>
                        <input id="nama_jurnal" type="text"
                            class="form-control @error('nama_jurnal') is-invalid @enderror" name="nama_jurnal"
                            value="{{ $value->nama_jurnal }}" required autofocus>
                        @error('nama_jurnal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="indeks" class="required-label">{{ __('Indeks') }}</label>
                        <input id="indeks" type="text"
                            class="form-control @error('indeks') is-invalid @enderror" name="indeks"
                            value="{{ $value->indeks }}" required autofocus>
                        @error('indeks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="waktu_terbit" class="required-label">{{ __('Waktu Terbit') }}</label>
                        <input id="waktu_terbit" type="text"
                            class="form-control @error('waktu_terbit') is-invalid @enderror" name="waktu_terbit"
                            value="{{ $value->waktu_terbit }}" required autofocus>
                        @error('waktu_terbit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="bidang" class="required-label">{{ __('Bidang') }}</label>
                        <input id="bidang" type="text"
                            class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                            value="{{ $value->bidang }}" required autofocus>
                        @error('bidang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="biaya" class="required-label">{{ __('Biaya') }}</label>
                        <input id="biaya" type="number"
                            class="form-control @error('biaya') is-invalid @enderror" name="biaya"
                            value="{{ $value->biaya }}" required autofocus>
                        @error('biaya')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="link_jurnal" class="required-label">{{ __('Link Jurnal') }}</label>
                        <input id="link_jurnal" type="text"
                            class="form-control @error('link_jurnal') is-invalid @enderror" name="link_jurnal"
                            value="{{ $value->link_jurnal }}" required autofocus>
                        @error('link_jurnal')
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
@endsection
