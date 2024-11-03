@extends('layouts.app-general')

@section('title', 'My Himsi - Arsip Kepengurusan Himsi')

@section('content')
    <div class="arsip">
        <div class="anggota">
            <div class="card">
                <h2 class="heading">Anggota Non Aktif</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="anggotaTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">Angkatan</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Divisi</th>
                                    <th class="text-center">Jabatan Terakhir</th>
                                    <th class="text-center">Periode</th>
                                    <th class="text-center">Link Media Sosial</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($anggota as $value)
                                    @if ($value->periode->keterangan !== 'Aktif')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                @if ($value->foto)
                                                    <a href="{{ asset('image/anggota/' . $value->foto) }}" target="_blank">
                                                        <img src="{{ asset('image/anggota/' . $value->foto) }}"
                                                            alt="profil" style="width:100px; height: 100px;"
                                                            class="d-inline-block align-text-center rounded-circle table-img" />
                                                    </a>
                                                @else
                                                    <a href="{{ asset('image/profil.jpg') }}" target="_blank">
                                                        <img src="{{ asset('image/profil.jpg') }}" alt="profil"
                                                            style="width:100px; height: 100px;"
                                                            class="d-inline-block align-text-center rounded-circle table-img">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $value->full_name }}</td>
                                            <td class="text-center">{{ $value->nim }}</td>
                                            <td class="text-center">{{ $value->angkatan }}</td>
                                            <td class="text-center">{{ $value->jenis_kelamin }}</td>
                                            <td>{{ $value->divisi->nama_divisi }}</td>
                                            <td>{{ $value->jabatan->nama_jabatan }}</td>
                                            <td>{{ $value->periode->periode }}</td>
                                            <td class="text-center">
                                                    <a href="{{ $value->link_linkedin }}" target="_blank" rel="noopener noreferrer"><i class='bx bxl-linkedin-square fs-1 mx-2' ></i></a>
                                                    <a href="{{ $value->link_ig }}" target="_blank" rel="noopener noreferrer"><i
                                                            class='bx bxl-instagram-alt fs-1 mx-2'></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="divisi">
            <div class="card">
                <h2 class="heading">Divisi Non Aktif</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="divisiTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Divisi</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Periode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($divisi as $no => $value)
                                    @if ($value->periode->keterangan !== 'Aktif')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td>{{ $value->nama_divisi }}</td>
                                            <td>{{ $value->deskripsi }}</td>
                                            <td>{{ $value->periode->periode }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="jabatan">
            <div class="card">
                <h2 class="heading">Jabatan Non Aktif</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="jabatanTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Periode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($jabatan as $no => $value)
                                    @if ($value->periode->keterangan !== 'Aktif')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td>{{ $value->nama_jabatan }}</td>
                                            <td>{{ $value->deskripsi }}</td>
                                            <td>{{ $value->periode->periode }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="proker">
            <div class="card">
                <h2 class="heading">Proker Non Aktif</h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="prokerTable" class="table table-responsive table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Program Kerja</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Divisi Penanggungjawab</th>
                                    <th class="text-center">Periode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($proker as $no => $value)
                                    @if ($value->periode->keterangan !== 'Aktif')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td>{{ $value->judul_proker }}</td>
                                            <td>{{ $value->deskripsi }}</td>
                                            <td>{{ $value->divisi->nama_divisi }}</td>
                                            <td>{{ $value->periode->periode }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#anggotaTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
                $('#divisiTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
                $('#jabatanTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
                $('#prokerTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
            });
        </script>
    @endpush
@endsection
