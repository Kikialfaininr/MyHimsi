@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA HaKI MAHASISWA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Mahasiswa Pencipta</th>
                            <th class="text-center">Nomor Paten</th>
                            <th class="text-center">Tanggal Terbit</th>
                            <th class="text-center">Judul Ciptaan</th>
                            <th class="text-center">Jenis Ciptaan</th>
                </tr>
            </thead>
            <tbody>
                @if ($haki->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ada</td>
                    </tr>
                @else
                    @foreach ($haki as $no => $value)
                    @if ($value->status == 'Diterima')
                        <tr>
                            <td align="center">{{ $no + 1 }}</td>
                            <td>
                                @php
                                    $lines = explode("\n", $value->nama_mahasiswa);
                                @endphp
                                
                                @if (count($lines) > 1)
                                    @foreach($lines as $index => $line)
                                        {{ $index + 1 }}. {!! nl2br(e($line)) !!}<br>
                                    @endforeach
                                @else
                                    {!! nl2br(e($lines[0])) !!}
                                @endif
                            </td>
                            <td>{{ $value->nomor }}</td>
                            <td>{{ \Carbon\Carbon::parse($value->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                            <td>{{ $value->judul }}</td>
                            <td>{{ $value->bentuk }}</td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
