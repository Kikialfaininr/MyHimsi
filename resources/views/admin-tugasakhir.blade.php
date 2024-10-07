@extends('layouts.app')

@section('title', 'Data Tugas Akhir')

@section('content')
    <div class="dataCard">
        <h2>Data Tugas Akhir Mahasiswa</h2>
        <div class="col-md-12 col-xs-12">
            {{-- alert --}}
            <div class="alertCrd">
                @if (session()->has('message'))
                    @php
                        $alertClass = session('alert_class', 'success');
                    @endphp

                    <div class="alert alert-{{ $alertClass }}">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#TambahDataTA" title="Tambah Data">
                        <i class='bx bx-plus'></i> Tambah Data Tugas Akhir
                    </button>
                    <a href="{{ url('downloadpdf-tugasakhir') }}" target="_blank">
                        <button class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Cetak Tugas Akhir
                        </button>
                    </a>
                </div>
            </div>
        </div>
        {{-- tabel data --}}
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table table-responsive table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Pengajuan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Judul Tugas Akhir</th>
                            <th class="text-center">Jenis Tugas Akhir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugasakhir as $no => $value)
                            <tr>
                                <td align="center">{{ $no + 1 }}</td>
                                <td>{{ $value->users->name }}</td>
                                <td>
                                    @if(is_null($value->status))
                                        <button class="btn btn-success btn-sm" onclick="confirmStatus('Terima', '{{ url('status-tugasakhir/' . $value->id_ta) }}')"><i class='bx bx-check'></i></button>
                                        <button class="btn btn-danger btn-sm" onclick="confirmStatus('Tolak', '{{ url('status-tugasakhir/' . $value->id_ta) }}')"><i class='bx bx-x'></i>                                        </button>
                                    @else
                                        <span class="{{ $value->status === 'Diterima' ? 'text-success' : 'text-danger' }}">
                                            {{ $value->status }}
                                        </span>
                                    @endif
                                </td>
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
                                <td>{{ $value->bentuk }}</td>
                                <td class="action-col">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UbahTA{{ $value->id_ta }}" title="Ubah Data">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <a href="{{ url($value->id_ta . '/hapus-tugasakhir') }}">
                                        <button title="Hapus Data" class="btn btn-danger btn-sm">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- tambah data --}}
    <div class="modal" id="TambahDataTA" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Tugas Akhir</h4>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('simpan-data-tugasakhir') }}">
                        @csrf
                        <div>
                            <label for="nama_mahasiswa" class="required-label">{{ __('Nama Mahasiswa') }}</label>
                            <textarea id="nama_mahasiswa"
                                class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa"
                                value="{{ old('nama_mahasiswa') }}" required autofocus></textarea>
                            @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang menjadi penulis tugas akhir dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                        </div>
                        <div>
                            <label for="judul" class="required-label">{{ __('Judul Tugas Akhir') }}</label>
                            <input id="judul" type="text"
                                class="form-control @error('judul') is-invalid @enderror" name="judul"
                                value="{{ old('judul') }}" required autofocus>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="bentuk" class="required-label">{{ __('Jenis Tugas Akhir') }}</label>
                            <input id="bentuk" type="text"
                                class="form-control @error('bentuk') is-invalid @enderror" name="bentuk"
                                value="{{ old('bentuk') }}" required autofocus>
                            @error('bentuk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-md-end"></label>
                            <div class="col-md-8">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- edit data --}}
    @foreach ($tugasakhir as $no => $value)
        <div class="modal" id="UbahTA{{ $value->id_ta }}" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Tugas Akhir</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('update-tugasakhir/' . $value->id_ta) }}">
                            @csrf
                            <div>
                                <label for="nama_mahasiswa" class="required-label">{{ __('Mahasiswa Pencipta') }}</label>
                                <textarea id="nama_mahasiswa" 
                                          class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                          name="nama_mahasiswa" 
                                          required autofocus>{{ old('nama_mahasiswa', $value->nama_mahasiswa) }}</textarea>
                                @error('nama_mahasiswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="form-text text-muted">* Jika Lebih dari 1 nama, cantumkan semua nama mahasiswa yang menjadi penulis tugas akhir dengan memisahkannya menggunakan enter tanpa penomoran.</p>
                            </div>
                            <div>
                                <label for="judul" class="required-label">{{ __('Judul Tugas Akhir') }}</label>
                                <input id="judul" type="text"
                                    class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ $value->judul }}" required autofocus>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="bentuk" class="required-label">{{ __('Jenis Tugas Akhir') }}</label>
                                <input id="bentuk" type="text"
                                    class="form-control @error('bentuk') is-invalid @enderror" name="bentuk"
                                    value="{{ $value->bentuk }}" required autofocus>
                                @error('bentuk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-md-end"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                });
            });
        </script>
    @endpush

    <script>
        function confirmStatus(action, url) {
            let textMessage = action === 'Terima' ? 'Terima pengajuan publikasi tugas akhir mahasiswa?' : 'Tolak pengajuan publikasi tugas akhir mahasiswa?';
            Swal.fire({
                title: textMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, ' + action,
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
    
                    let csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);
    
                    let statusField = document.createElement('input');
                    statusField.type = 'hidden';
                    statusField.name = 'status';
                    statusField.value = action === 'Terima' ? 'Diterima' : 'Ditolak';
                    form.appendChild(statusField);
    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
