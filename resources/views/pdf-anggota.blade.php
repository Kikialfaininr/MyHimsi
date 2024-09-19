@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA ANGGOTA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Lengkap</th>
                    <th class="text-center">NIM</th>
                    <th class="text-center">Angkatan</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Divisi</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Link Instagram</th>
                    <th class="text-center">Link Linkedin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $no => $value)
                    <tr>
                        <td class="text-center">{{ $no + 1 }}</td>
                        <td>{{ $value->full_name }}</td>
                        <td class="text-center">{{ $value->nim }}</td>
                        <td class="text-center">{{ $value->angkatan }}</td>
                        <td class="text-center">{{ $value->jenis_kelamin }}</td>
                        <td>{{ $value->divisi->nama_divisi }}</td>
                        <td>{{ $value->jabatan->nama_jabatan }}</td>
                        <td>
                            @if ($value->link_ig)
                                <a href="{{ $value->link_ig }}" target="_blank">Link Instagram</a>
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if ($value->link_linkedin)
                                <a href="{{ $value->link_linkedin }}" target="_blank">Link Linkedin</a>
                            @else
                                
                            @endif
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
