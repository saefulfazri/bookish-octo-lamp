@extends('layouts/app')
@section('content')
    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Karyawan <i
                class="fa-solid fa-arrow-right pl-2 mr-2"></i>data karyawan personal </h1>
        <a href="{{ route('karyawan.index') }}" class="btn bg-danger text-white">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="container_table">
        <a href="{{ route('datakaryawan.edit', $karyawan->id_karyawan) }}" class="btn bg-success text-white">Edit</a>
        <div class="box-table">
            <table class="table-personal">
                <tr>
                    <th>ID-Karyawan</th>
                    <td>:</td>
                    <td>{{ $karyawan->id_karyawan }}</td>

                </tr>
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis kelamin</th>
                    <td>:</td>
                    <td>{{ $karyawan->jenis_kelamin }}</td>

                </tr>
                <tr>
                    <th>tanggal lahir</th>
                    <td>:</td>
                    <td>{{ $karyawan->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>pendidikan terakhir</th>
                    <td>:</td>
                    <td>{{ $karyawan->pendidikan_terakhir }}</td>
                </tr>
                <tr>
                    <th>alamat</th>
                    <td>:</td>
                    <td>{{ $karyawan->alamat }}</td>
                </tr>
                <tr>
                    <th>nomor</th>
                    <td>:</td>
                    <td>{{ $karyawan->nomor }}</td>
                </tr>
                <tr>
                    <th>mulai bekerja</th>
                    <td>:</td>
                    <td>{{ $karyawan->mulai_bekerja }}</td>
                </tr>
                <tr>
                    <th>jabatan</th>
                    <td>:</td>
                    <td>{{ $karyawan->jabatan ?? 'belum memiliki' }}</td>
                </tr>
                <tr>
                    <th>divisi</th>
                    <td>:</td>
                    <td>{{ $karyawan->divisi ?? 'belum memiliki' }}</td>
                </tr>
                <tr>
                    <th>barcode</th>
                    <td>:</td>
                    <td>
                        @if ($karyawan->barcode)
                            <img src="data:image/png;base64,{{ $karyawan->barcode }}" alt="Barcode {{ $karyawan->nama }}">
                        @else
                            <p>Barcode tidak tersedia.</p>
                        @endif
                </tr>
            </table>
        </div>
    </div>
@endsection
