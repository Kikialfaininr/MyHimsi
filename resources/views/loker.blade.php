@extends('layouts.app-general')

@section('title', 'My Himsi - Informasi Lowongan Kerja dan Magang')

@section('content')
    <div class="loker">
        {{-- Title --}}
        <div class="loker-title text-center">
            <h2>Informasi Lowongan Kerja dan Magang</h2>
            <form action="{{ url('loker') }}" method="GET">
                <div class="search-bar">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Cari posisi, perusahaan, lokasi, atau jenis pekerjaan"
                        value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <div class="loker-content">
            <div class="row">
                <div class="col-sm-4">
                    @foreach ($loker as $no => $value)
                        <div class="lokerList">
                            <div class="card" data-posisi="{{ $value->posisi }}"
                                data-nama_perusahaan="{{ $value->nama_perusahaan }}" data-lokasi="{{ $value->lokasi }}"
                                data-jenis_pekerjaan="{{ $value->jenis_pekerjaan }}"
                                data-gaji="{{ $value->gaji ? 'Rp ' . number_format($value->gaji) : '-' }}"
                                data-deskripsi="{{ $value->deskripsi }}" data-link_apply="{{ $value->link_apply }}"
                                onclick="showDetail(this)">
                                <h5>{{ $value->posisi }}</h5>
                                <h4>{{ $value->nama_perusahaan }}</h4>
                                <h6>{{ $value->lokasi }}</h6>
                                <p>{{ $value->jenis_pekerjaan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-8">
                    <div class="lokerDetail">
                        <div class="card" id="detail-card">
                            <h2 id="placeholder-detail"><i class='bx bx-left-arrow-alt'></i> Pilih lowongan untuk melihat
                                detail</h2>
                            <h5 id="detail-posisi" style="display: none;"></h5>
                            <h4 id="detail-nama_perusahaan"></h4>
                            <h6 id="detail-lokasi"></h6>
                            <h6 id="detail-jenis_pekerjaan"></h6>
                            <h6 id="detail-gaji"></h6>
                            <a href="#" id="detail-link_apply" target="_blank" class="btn btn-primary"
                                style="display: none;"><i class='bx bx-paper-plane'></i> Lamar</a>
                            <p id="detail-deskripsi"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(element) {
            const posisi = element.getAttribute('data-posisi');
            const placeholder = document.getElementById('placeholder-detail');
            const detailPosisi = document.getElementById('detail-posisi');
    
            // Sembunyikan placeholder dan tampilkan detail posisi
            placeholder.style.display = 'none';
            detailPosisi.innerText = posisi;
            detailPosisi.style.display = 'block';
    
            const namaPerusahaan = element.getAttribute('data-nama_perusahaan');
            const lokasi = element.getAttribute('data-lokasi');
            const jenisPekerjaan = element.getAttribute('data-jenis_pekerjaan');
            const gaji = element.getAttribute('data-gaji');
            const deskripsi = element.getAttribute('data-deskripsi');
            const linkApply = element.getAttribute('data-link_apply');
    
            // Update elemen di lokerDetail
            document.getElementById('detail-posisi').innerText = posisi;
            document.getElementById('detail-nama_perusahaan').innerText = namaPerusahaan;
            document.getElementById('detail-lokasi').innerHTML = `<i class='bx bx-location-plus'></i> ${lokasi}`;
            document.getElementById('detail-jenis_pekerjaan').innerHTML =
                `<i class='bx bx-time-five'></i> ${jenisPekerjaan}`;
            document.getElementById('detail-gaji').innerHTML = `<i class='bx bx-money'></i> ${gaji}`;
            document.getElementById('detail-deskripsi').innerText = deskripsi;
    
            // Tampilkan tombol "Lamar" dan update URL-nya
            const lamarButton = document.getElementById('detail-link_apply');
            lamarButton.style.display = 'block';
            lamarButton.setAttribute('href', linkApply);
    
            // Scroll otomatis ke lokerDetail
            const lokerDetailElement = document.querySelector('.lokerDetail');
            const offset = 80;  // Margin-top offset
    
            // Scroll ke bagian elemen
            window.scrollTo({
                top: lokerDetailElement.offsetTop - offset,  // Kurangi offset agar ada jarak 80px dari atas
                behavior: 'smooth'
            });
        }
    </script>
    
    
    
@endsection
