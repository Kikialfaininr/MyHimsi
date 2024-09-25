@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA DIVISI</h1>
        <h3>Divisi {{ $periode->keterangan }} {{ $periode->periode }}</h3>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Divisi</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Periode</th>
                </tr>
            </thead>
            <tbody>
                @if ($divisi->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ada</td>
                    </tr>
                @else
                    @foreach ($divisi as $no => $value)
                        <tr>
                            <td align="center">{{ $no + 1 }}</td>
                            <td>{{ $value->nama_divisi }}</td>
                            <td>{{ $value->deskripsi }}</td>
                            <td>{{ $value->periode->periode }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>        
    </div>
@endsection
