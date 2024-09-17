@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA SERTIFIKAT</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Sertifikat</th>
                    <th class="text-center">Link Sertifikat</th>
                    <th class="text-center">Kategori</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($sertifikat as $no => $value)
                    <tr>
                        <td align="center">{{$no+1}}</td>
                        <td>{{$value->nama_sertifikat}}</td>
                        <td>
                            <a href="{{ $value->link_sertifikat }}" target="_blank">Link Sertifikat</a>
                        </td>
                        <td>{{$value->kategori}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
