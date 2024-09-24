@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
    @if (request('start_date') && request('end_date'))
        <div class="alert alert-info">
            Menampilkan data kehadiran dari {{ request('start_date') }} sampai {{ request('end_date') }}.
        </div>
    @endif
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Kehadiran</h1>
            <form method="GET" class="d-flex" action="{{ route('data_kehadiran.index') }}" class="mb-3"
                style="align-items: flex-end;">

                <div class="mr-1">
                    <label for="start_date" class="text-white">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
                <div class="mr-1">
                    <label for="end_date" class="text-white">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>

                <button type="submit" class="btn btn-primary position-bottom">Filter</button>


            </form>
        </div>

        <div class="card box-blur mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <a href="{{ route('data_kehadiran.create') }}" class="btn btn-primary mb-3">Tambahkan data manual</a>
                    <a href="{{ route('absen.kehadiran') }}" class="btn btn-primary mb-3">absen lewat web</a>
                    <a href="{{ route('absen.konfirmasi_izin') }}" class="btn btn-primary mb-3">izin lewat web</a>
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_absensi</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Hadir</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Ketepatan Waktu</th>
                                <th>Lama Kerja</th>
                                <th>Status Hadir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKehadiran as $kehadiran)
                                <tr>
                                    <td>{{ $kehadiran->id_absensi }}</td>
                                    <td>{{ $kehadiran->karyawan->nama }}</td>
                                    <td>{{ $kehadiran->tanggal_hadir }}</td>
                                    <td>{{ $kehadiran->waktu_masuk }}</td>
                                    <td>{{ $kehadiran->waktu_keluar }}</td>
                                    <td>
                                        @php
                                            $ketepatanClass = match ($kehadiran->ketepatan_waktu) {
                                                'On Time' => 'btn-primary',
                                                'Telat' => 'btn-danger',
                                                default => 'd-none',
                                            };
                                        @endphp
                                        <button class="btn btn-sm {{ $ketepatanClass }}">
                                            {{ $kehadiran->ketepatan_waktu }}
                                        </button>
                                    </td>
                                    <td>{{ $kehadiran->lama_kerja }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($kehadiran->status_hadir) {
                                                'Hadir' => 'btn-success',
                                                'Sakit' => 'btn-warning',
                                                'Izin' => 'btn-info',
                                                'Tidak Hadir' => 'btn-danger',
                                                default => 'btn-secondary',
                                            };
                                        @endphp
                                        <button class="btn {{ $statusClass }}">
                                            {{ $kehadiran->status_hadir }}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('data_kehadiran.show', $kehadiran->id_absensi) }}"
                                            class="btn btn-info ">Lihat</a>
                                        <a class="btn bg-warning text-white"
                                            href="{{ route('data_kehadiran.edit', $kehadiran->id_absensi) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('data_kehadiran.destroy', $kehadiran->id_absensi) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-danger text-white btn-delete" type="button"
                                                data-action="{{ route('data_kehadiran.destroy', $kehadiran->id_absensi) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
