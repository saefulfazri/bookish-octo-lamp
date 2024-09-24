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
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Karyawan</h1>
        </div>
        <div class="card box-blur mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambahkan data</a>
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id karyawan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Status Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $data)
                                <tr>
                                    <td>{{ $data->id_karyawan }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->jabatan ?? 'tidak memiliki jabatan' }}</td>
                                    <td>{{ $data->divisi ?? 'tidak memiliki divisi' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($data->Status_Karyawan) {
                                                'Aktif' => 'btn-success',
                                                'tidak aktif' => 'btn-danger',
                                                default => 'btn-secondary',
                                            };
                                        @endphp
                                        <button class="btn btn-sm {{ $statusClass }}">
                                            {{ $data->Status_Karyawan }}
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn bg-primary text-white"
                                            href="{{ route('karyawan.show', $data->id_karyawan) }}">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('karyawan.destroy', $data->id_karyawan) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-danger text-white btn-delete" type="button"
                                                data-action="{{ route('karyawan.destroy', $data->id_karyawan) }}">
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
