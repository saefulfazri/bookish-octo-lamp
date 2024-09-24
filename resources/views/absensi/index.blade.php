@extends('layouts/app')
@section('content')
    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Absensi Karyawan</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <a href="{{ route('absen_karyawan.form') }}" class="btn btn-primary mb-3">Tambahkan data</a>
                    <a href="{{ route('absen_karyawan.store_izin') }}" class="btn btn-primary mb-3">izin</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Absen</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status Absen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->karyawan->nama }}</td>
                                    <td>{{ $data->tanggal_hadir }}</td>
                                    <td>{{ $data->jam_masuk ?? '-' }}</td>
                                    <td>{{ $data->jam_keluar ?? '-' }}</td>
                                    <td> @php
                                        $statusClass = match ($data->status_hadir) {
                                            'Hadir' => 'btn-success',
                                            'Sakit' => 'btn-warning',
                                            'Izin' => 'btn-info',
                                            'Tidak Hadir' => 'btn-danger',
                                            default => 'btn-secondary',
                                        };
                                    @endphp
                                        <button class="btn btn-sm {{ $statusClass }}">
                                            {{ $data->status_hadir }}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('absensi.show', $data->id) }}" class="btn btn-info ">Lihat</a>
                                        <form action="{{ route('absensi.destroy', $data->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger "><i
                                                    class="fas fa-trash"></i></button>
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
