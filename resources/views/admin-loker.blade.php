@extends('layouts.app')

@section('title', 'Data Lowongan Kerja')

@section('content')
<div class="dataCard">
    <h2>Data Lowongan Kerja</h2>
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
                    data-bs-toggle="modal" data-bs-target="#TambahDataLoker" title="Tambah Data">
                    <i class='bx bx-plus'></i> Tambah Data Loker
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
                        <th class="text-center">Posisi</th>
                        <th class="text-center">Perusahaan</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-center">Gaji</th>
                        <th class="text-center">Jenis Pekerjaan</th>
                        <th class="text-center">Link Apply</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loker as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->posisi}}</td>
                        <td>{{$value->nama_perusahaan}}</td>
                        <td>{{$value->lokasi}}</td>
                        <td>
                            @if ($value->gaji)
                                Rp {{ number_format($value->gaji) }}
                            @else
                                
                            @endif
                        </td>                        
                        <td>{{$value->jenis_pekerjaan}}</td>
                        <td>
                            <a href="{{ $value->link_apply }}" target="_blank">{{ $value->link_apply }}</a>
                        </td> 
                        <td class="action-col">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#Deskripsi{{ $value->id_loker }}" title="Deskripsi Pekerjaan">
                                Selengkapnya
                            </button>
                        </td>       
                        <td class="action-col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#UbahLoker{{$value->id_loker}}" title="Ubah Data">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <a href="{{url($value->id_loker.'/hapus-loker')}}">
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

{{-- detail loker --}}
@foreach($loker as $no => $value)
<div class="modal" id="Deskripsi{{$value->id_loker}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deskripsi Pekerjaan</h4>
            </div>
            <div class="modal-body">
                <h4>{{$value->posisi}} - {{$value->nama_perusahaan}}</h4>
                <p><strong>Deskripsi:</strong></p>
                <p>{!! nl2br(e($value->deskripsi)) !!}</p>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- tambah data --}}
<div class="modal" id="TambahDataLoker" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Loker</h4>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="POST" action="{{url('simpan-data-loker')}}">
                    @csrf
                    <div>
                        <label for="posisi" class="required-label">{{ __('Posisi') }}</label>
                        <input id="posisi" type="text"
                            class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                            value="{{ old('posisi') }}" required autofocus>
                        @error('posisi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_perusahaan" class="required-label">{{ __('Nama Perusahaan') }}</label>
                        <input id="nama_perusahaan" type="text"
                            class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan') }}" required autofocus>
                        @error('nama_perusahaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="lokasi" class="required-label">{{ __('Lokasi') }}</label>
                        <input id="lokasi" type="text"
                            class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                            value="{{ old('lokasi') }}" required autofocus>
                        @error('lokasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="gaji">{{ __('Gaji') }}</label>
                        <input id="gaji" type="number"
                            class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                            value="{{ old('gaji') }}" autofocus>
                        @error('gaji')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_pekerjaan" class="required-label">{{ __('Jenis Pekerjaan') }}</label>
                        <select id="jenis_pekerjaan" class="form-control @error('jenis_pekerjaan') is-invalid @enderror" name="jenis_pekerjaan" required autofocus>
                            <option value="" selected disabled>Pilih Jenis Pekerjaan</option>
                            <option value="Full time">Full time</option>
                            <option value="Part time">Part time</option>
                            <option value="Magang">Magang</option>
                        </select>
                        @error('jenis_pekerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> 
                    <div>
                        <label for="link_apply" class="required-label">{{ __('Link Apply') }}</label>
                        <input id="link_apply" type="text"
                            class="form-control @error('link_apply') is-invalid @enderror" name="link_apply"
                            value="{{ old('link_apply') }}" required autofocus>
                        @error('link_apply')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>  
                    <div>
                        <label for="deskripsi" class="required-label">{{ __('Deskripsi') }}</label>
                        <textarea 
                            class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" type="text" name="deskripsi"
                            value="{{ old('deskripsi') }}" required autofocus></textarea>
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
@foreach($loker as $no => $value)
<div class="modal" id="UbahLoker{{$value->id_loker}}" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data loker</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('update-loker/'.$value->id_loker)}}">
                    @csrf
                    <div>
                        <label for="posisi" class="required-label">{{ __('Posisi') }}</label>
                        <input id="posisi" type="text"
                            class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                            value="{{ $value->posisi }}" required autofocus>
                        @error('posisi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_perusahaan" class="required-label">{{ __('Nama Perusahaan') }}</label>
                        <input id="nama_perusahaan" type="text"
                            class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan"
                            value="{{ $value->nama_perusahaan }}" required autofocus>
                        @error('nama_perusahaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="lokasi" class="required-label">{{ __('Lokasi') }}</label>
                        <input id="lokasi" type="text"
                            class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                            value="{{ $value->lokasi }}" required autofocus>
                        @error('lokasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="gaji">{{ __('Gaji') }}</label>
                        <input id="gaji" type="number"
                            class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                            value="{{ $value->gaji }}" autofocus>
                        @error('gaji')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_pekerjaan" class="required-label">{{ __('jenis_pekerjaan') }}</label>
                        <select id="jenis_pekerjaan" class="form-control @error('jenis_pekerjaan') is-invalid @enderror" name="jenis_pekerjaan" required autofocus>
                            <option value="Full time" {{ $value->jenis_pekerjaan == 'Full time' ? 'selected' : '' }}>Full time</option>
                            <option value="Part time" {{ $value->jenis_pekerjaan == 'Part time' ? 'selected' : '' }}>Part time</option>
                            <option value="Magang" {{ $value->jenis_pekerjaan == 'Magang' ? 'selected' : '' }}>Magang</option>
                        </select>
                        @error('jenis_pekerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="link_apply" class="required-label">{{ __('Link Apply') }}</label>
                        <input id="link_apply" type="text"
                            class="form-control @error('link_apply') is-invalid @enderror" name="link_apply"
                            value="{{ $value->link_apply }}" required autofocus>
                        @error('link_apply')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="deskripsi" class="required-label">{{ __('Deskripsi') }}</label>
                        <textarea id="deskripsi" 
                                  class="form-control @error('deskripsi') is-invalid @enderror" 
                                  name="deskripsi" 
                                  required autofocus>{{ old('deskripsi', $value->deskripsi) }}</textarea>
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
