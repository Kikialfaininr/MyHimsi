@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA DIVISI</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Divisi</th>
                    <th class="text-center">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($divisi as $no => $value)
                    <tr>
                        <td align="center">{{ $no + 1 }}</td>
                        <td>{{ $value->nama_divisi }}</td>
                        <td>{{ $value->deskripsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
