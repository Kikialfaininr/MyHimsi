@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA ARTIKEL PUBLIKASI MAHASISWA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Author Mahasiswa</th>
                    <th class="text-center">Judul Artikel</th>
                    <th class="text-center">Link Artikel</th>
                </tr>
            </thead>
            <tbody>
                @if ($artikel->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ada</td>
                    </tr>
                @else
                    @foreach ($artikel as $no => $value)
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
                            <td>{{ $value->judul }}</td>
                            <td>
                                <a href="{{ $value->link_artikel }}" target="_blank">Link Artikel</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
