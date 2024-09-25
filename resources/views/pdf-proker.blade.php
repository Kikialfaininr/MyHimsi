@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA PROGRAM KERJA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Program Kerja</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Divisi Penanggungjawab</th>
                    <th class="text-center">Periode</th>
                </tr>
            </thead>
            <tbody>
                @if ($proker->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Data tidak ada</td>
                    </tr>
                @else
                    @foreach ($proker as $no => $value)
                        <tr>
                            <td align="center">{{ $no + 1 }}</td>
                            <td>{{ $value->judul_proker }}</td>
                            <td>{{ $value->deskripsi }}</td>
                            <td>{{ $value->divisi->nama_divisi }}</td>
                            <td>{{ $value->periode->periode }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>        
    </div>
@endsection
    
