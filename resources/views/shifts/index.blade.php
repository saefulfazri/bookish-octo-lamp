@extends('layouts/app')
@section('content')
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
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Shift</h1>
        </div>
        <div class="alert alert-info">
            shifts ini belum bisa di gunakan untuk lintas waktu
        </div>
        <div class="card box-blur mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <a href="{{ route('shifts.create') }}" class="btn btn-primary mb-3">Tambahkan data</a>
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Shift</th>
                                <th>Jam Mulai</th>
                                <th>Jam selesai</th>
                                <th>Jam bekerja</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $data)
                                @php
                                    $jamMulai = strtotime($data->jam_mulai);
                                    $jamSelesai = strtotime($data->jam_selesai);

                                    $selisihDetik = $jamSelesai - $jamMulai;

                                    // Menghitung jam dan menit dari selisih detik
                                    $jam = floor($selisihDetik / 3600);
                                    $menit = floor(($selisihDetik % 3600) / 60);

                                    // Format dalam bentuk 'H:i'
                                    $lamaKerja = sprintf('%d jam %d menit', $jam, $menit);
                                @endphp
                                <tr>
                                    <td>{{ $data->nama_shift }}</td>
                                    <td>{{ $data->jam_mulai }}</td>
                                    <td>{{ $data->jam_selesai }}</td>
                                    <td>{{ $lamaKerja }}</td>
                                    <td>
                                        <a class="btn bg-warning text-white" href="{{ route('shifts.edit', $data->id) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('shifts.destroy', $data->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-danger text-white btn-delete" type="button"
                                                data-action="{{ route('shifts.destroy', $data->id) }}">
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
