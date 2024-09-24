@extends('layouts/app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">data absensi karyawan personal</h1>
        <a href="{{ route('absensi.index') }}" class="btn bg-danger text-white">back</a>
    </div>
    <div class="container_table">
        <div class="box-table">
            <table class="table-personal">
                <tr>
                    <th>Nama Karyawan</th>
                    <td>:</td>
                    <td>{{ $absensi->karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Hadir</th>
                    <td>:</td>
                    <td>{{ $absensi->tanggal_hadir }}</td>
                </tr>
                <tr>
                    <th>Jam Masuk</th>
                    <td>:</td>
                    <td>{{ $absensi->jam_masuk }}</td>
                </tr>
                <tr>
                    <th>Jam Keluar</th>
                    <td>:</td>
                    <td>{{ $absensi->jam_keluar }}</td>
                </tr>
                <tr>
                    <th>Status Hadir</th>
                    <td>:</td>
                    <td>{{ $absensi->status_hadir }}</td>
                </tr>
                <tr>
                    <th>Alasan</th>
                    <td>:</td>
                    <td>{{ $absensi->alasan_tidak_masuk }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
