@extends('layouts.app-general')

@section('title', 'My Himsi - Publikasi Jurnal')

@section('content')
    <div class="publikasi">
        {{-- Title --}}
        <div class="publikasi-title text-center">
            <h2>Publikasi Jurnal</h2>
            <p>Informasi tentang jurnal yang tersedia untuk publikasi</p>
            <form action="{{ url('publikasi') }}" method="GET">
                <div class="search-bar">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Cari jurnal, waktu terbit, indeks, atau bidang"
                        value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <div class="container publikasi-content my-5">
            @if ($message)
                <div class="alert alert-warning">{{ $message }}</div>
            @endif
            <div class="row justify-content-center">
                @foreach ($publikasi as $no => $value)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value->nama_jurnal }}</h5>
                                <div class="card-text">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th scope="col">Waktu Terbit</th>
                                                <td scope="row">{{ $value->waktu_terbit }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Bidang</th>
                                                <td>{{ $value->bidang }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Index</th>
                                                <td>{{ $value->indeks }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Biaya</th>
                                                <td>Rp {{ number_format($value->biaya) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ $value->link_jurnal }}" target="_blank" class="btn btn-primary">Lihat
                                        Jurnal</a>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
