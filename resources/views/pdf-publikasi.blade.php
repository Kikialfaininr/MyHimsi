@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA PUBLIKASI JURNAL</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jurnal</th>
                    <th class="text-center">Indeks</th>
                    <th class="text-center">Waktu Terbit</th>
                    <th class="text-center">Bidang</th>
                    <th class="text-center">Biaya</th>
                    <th class="text-center">Link Jurnal</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($publikasi as $no => $value)
                    <tr>
                        <td align="center">{{ $no + 1 }}</td>
                        <td>{{ $value->nama_jurnal }}</td>
                        <td>{{ $value->indeks }}</td>
                        <td>{{ $value->waktu_terbit }}</td>
                        <td>{{ $value->bidang }}</td>
                        <td>Rp {{ number_format($value->biaya) }}</td>
                        <td>
                            <a href="{{ $value->link_jurnal }}" target="_blank">Link Jurnal</a>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
