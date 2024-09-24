@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data kehadiran <i
                class="fa-solid fa-arrow-right pl-2 mr-2"></i>show kehadiran </h1>
        <a href="{{ route('data_kehadiran.index') }}" class="btn bg-danger text-white">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="container_table">
        <div class="box-table">
            <table class="table-personal">
                <tr>
                    <th>Nama Karyawan</th>
                    <td>:</td>
                    <td>{{ $dataKehadiran->karyawan->nama }}</td>

                </tr>
                <tr>
                    <th>Tanggal Hadir</th>
                    <td>:</td>
                    <td>{{ $dataKehadiran->tanggal_hadir }}</td>
                </tr>
                <tr>
                    <th>Waktu Masuk</th>
                    <td>:</td>
                    <td>{{ $dataKehadiran->waktu_masuk }}</td>

                </tr>
                <tr>
                    <th>Waktu Keluar</th>
                    <td>:</td>
                    <td> {{ $dataKehadiran->waktu_keluar }}</td>
                </tr>
                <tr>
                    <th>Ketepatan Waktu</th>
                    <td>:</td>
                    <td>{{ $dataKehadiran->ketepatan_waktu }}</td>
                </tr>
                <tr>
                    <th>Status Kehadiran</th>
                    <td>:</td>
                    <td> {{ $dataKehadiran->status_hadir }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>:</td>
                    <td>{{ $dataKehadiran->keterangan }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
