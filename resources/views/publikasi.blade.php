@extends('layouts.app-general')

@section('content')
<div class="publikasi">
    {{-- Title --}}
    <div class="publikasi-title text-center">
        <h2>Publikasi Jurnal</h2>
        <p>Informasi tentang jurnal yang tersedia untuk publikasi</p>
        <div class="search-bar">
            <button type="submit">
                <i class="bx bx-search"></i>
            </button>
            <input type="text" placeholder="Type to search...">
        </div>
    </div>
    
    <!-- Search dan Filter -->
    <div class="container publikasi-content my-5">
        <div class="row mb-4">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <select class="form-select d-inline-block w-auto me-2">
                    <option value="">Filter Bidang</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Sosial">Sosial</option>
                </select>
                <select class="form-select d-inline-block w-auto">
                    <option value="">Filter Indeks</option>
                    <option value="Scopus">Scopus</option>
                    <option value="Sinta">Sinta</option>
                </select>
            </div>
        </div>
    
        <!-- Jurnal Cards -->
        <div class="row justify-content-center">
            <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jurnal Teknologi Terbaru</h5>
                            <div class="card-text">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Waktu Terbit</th>
                                            <td scope="row">September 2024</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Bidang</th>
                                            <td>Data Science, Sistem Informasi, IoT</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Index</th>
                                            <td>Sinta 4</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Biaya</th>
                                            <td>Rp 200.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-primary">Lihat Jurnal</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jurnal Teknologi Terbaru</h5>
                            <div class="card-text">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Waktu Terbit</th>
                                            <td scope="row">September 2024</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Bidang</th>
                                            <td>Data Science, Sistem Informasi, IoT</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Index</th>
                                            <td>Sinta 4</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Biaya</th>
                                            <td>Rp 200.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-primary">Lihat Jurnal</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jurnal Teknologi Terbaru</h5>
                            <div class="card-text">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Waktu Terbit</th>
                                            <td scope="row">September 2024</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Bidang</th>
                                            <td>Data Science, Sistem Informasi, IoT</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Index</th>
                                            <td>Sinta 4</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Biaya</th>
                                            <td>Rp 200.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-primary">Lihat Jurnal</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
