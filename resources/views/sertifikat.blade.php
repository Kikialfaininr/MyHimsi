@extends('layouts.app-general')

@section('content')
    <div class="sertifikat">
        {{-- Title --}}
        <div class="sertifikat-title text-center">
            <h2>Sertifikat</h2>
            <div class="search-bar">
                <button type="submit">
                    <i class="bx bx-search"></i>
                </button>
                <input type="text" placeholder="Type to search...">
            </div>
        </div>

        <!-- Search dan Filter -->
        <div class="container sertifikat-content my-5">
            <div class="row mb-4">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <select class="form-select d-inline-block w-auto me-2">
                        <option value="">Kategori</option>
                        <option value="Seminar">Anggota</option>
                        <option value="Keanggotaan">Umum</option>
                    </select>
                </div>
            </div>

            <!-- Jurnal Cards -->
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sertifikat Keanggotaan Himpunan</h5>
                            <div class="card-text">
                                <a href="#" class="btn btn-primary">Download Sertifikat</a>
                                <h5 class="card-tag">Kategori: Anggota</h5>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sertifikat Keanggotaan Himpunan</h5>
                            <div class="card-text">
                                <a href="#" class="btn btn-primary">Download Sertifikat</a>
                                <h5 class="card-tag">Kategori: Anggota</h5>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sertifikat Keanggotaan Himpunan</h5>
                            <div class="card-text">
                                <a href="#" class="btn btn-primary">Download Sertifikat</a>
                                <h5 class="card-tag">Kategori: Anggota</h5>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
