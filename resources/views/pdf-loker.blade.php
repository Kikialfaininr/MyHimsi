@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA LOWONGN PEKERJAAN</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                        <th class="text-center">Posisi</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Perusahaan</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-center">Gaji</th>
                        <th class="text-center">Jenis Pekerjaan</th>
                        <th class="text-center">Link Apply</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loker as $no => $value)
                <tr>
                    <td align="center">{{$no+1}}</td>
                    <td>{{$value->posisi}}</td>
                    <td>{{$value->deskripsi}}</td>
                    <td>{{$value->nama_perusahaan}}</td>
                    <td>{{$value->lokasi}}</td>
                    <td>Rp {{ number_format($value->gaji) }}</td>
                    <td>{{$value->jenis_pekerjaan}}</td>
                    <td>
                        <a href="{{ $value->link_apply }}" target="_blank">Link Apply</a>
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
