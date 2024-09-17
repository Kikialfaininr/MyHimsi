@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA JABATAN</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jabatan as $no => $value)
                    <tr>
                        <td align="center">{{ $no + 1 }}</td>
                        <td>{{ $value->nama_jabatan }}</td>
                        <td>{{ $value->deskripsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
    
