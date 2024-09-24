@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2>Detail data</h2>
        <a href="{{ route('history_absensi.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            absensi
        </div>
        <div class="row">
            <div class="col m-3">
                <table class="table-personal">
                    <tr>
                        <th>Nama Karyawan</th>
                        <td>:</td>
                        <td>{{ $historyAbsensi->karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Hadir</th>
                        <td>:</td>
                        <td> {{ $historyAbsensi->tanggal_hadir }}</td>
                    </tr>
                    <tr>
                        <th>Jam Masuk</th>
                        <td>:</td>
                        <td>{{ $historyAbsensi->jam_masuk }}</td>
                    </tr>
                    <tr>
                        <th>Jam Keluar</th>
                        <td>:</td>
                        <td>{{ $historyAbsensi->jam_keluar }}</td>
                    </tr>
                    <tr>
                        <th>Status Hadir</th>
                        <td>:</td>
                        <td>{{ $historyAbsensi->status_hadir }}</td>
                    </tr>
                    <tr>
                        <th>Alasan</th>
                        <td>:</td>
                        <td>{{ $historyAbsensi->alasan_tidak_masuk }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
