@extends('layouts.app')

@section('content')
<div class="dataCard">
    <h2>Data Periode Kepengurusan</h2>
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
        @if(Auth::check() && Auth::user()->role == 'Admin')
        <div class="row">
            <div class="col-md-8">
                <button type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#TambahDataPeriode" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Periode
                </button>
            </div>
        </div>
        @endif
    </div>
    {{-- tabel data --}}
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="example" class="table table-responsive table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Keterangan</th>
                        @if(Auth::check() && Auth::user()->role == 'Admin')
                        <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($periode as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->periode}}</td>
                        <td>{{$value->keterangan}}</td>
                        @if(Auth::check() && Auth::user()->role == 'Admin')
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahPeriode{{$value->id_periode}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id_periode.'/hapus-periode')}}">
                                <button title="Hapus Data" class="btn btn-danger btn-sm">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </a>
                        </td>  
                        @endif  
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(Auth::check() && Auth::user()->role == 'Admin')
{{-- tambah data --}}
<div class="modal" id="TambahDataPeriode" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Periode</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-periode')}}">
                    @csrf
                    <div>
                        <label for="periode" class="required-label">{{ __('Periode') }}</label>
                        <input id="periode" type="text"
                            class="form-control @error('periode') is-invalid @enderror" name="periode"
                            value="{{ old('periode') }}" required autofocus>
                        @error('periode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="required-label">{{ __('Keterangan') }}</label>
                        <div>
                            <input id="aktif" type="radio" class="@error('keterangan') is-invalid @enderror" name="keterangan" value="Aktif" required>
                            <label for="aktif">Aktif</label>
                        </div>
                        <div>
                            <input id="non_aktif" type="radio" class="@error('keterangan') is-invalid @enderror" name="keterangan" value="Non Aktif" required>
                            <label for="non_aktif">Non Aktif</label>
                        </div>
                        @error('keterangan')
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
@foreach($periode as $no => $value)
<div class="modal" id="UbahPeriode{{$value->id_periode}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Periode</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-periode/'.$value->id_periode)}}">
                    @csrf
                    <div>
                        <label for="periode" class="required-label">{{ __('periode') }}</label>
                        <input id="periode" type="text"
                            class="form-control @error('periode') is-invalid @enderror" name="periode"
                            value="{{ $value->periode }}" required autofocus>
                        @error('periode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="required-label">{{ __('Keterangan') }}</label>
                        <div>
                            <input id="aktif" type="radio" class="@error('keterangan') is-invalid @enderror" name="keterangan" value="Aktif" {{ $value->keterangan == 'Aktif' ? 'checked' : '' }} required>
                            <label for="aktif">Aktif</label>
                        </div>
                        <div>
                            <input id="non_aktif" type="radio" class="@error('keterangan') is-invalid @enderror" name="keterangan" value="Non Aktif" {{ $value->keterangan == 'Non Aktif' ? 'checked' : '' }} required>
                            <label for="non_aktif">Non Aktif</label>
                        </div>
                        @error('keterangan')
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
@endif

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
