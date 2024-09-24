@extends('layouts.app')

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
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Rekap Absensi</h1>
        </div>
        <div class="card box-blur mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead >
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Total Hadir</th>
                                <th>Total Tidak Hadir</th>
                                <th>Total Sakit</th>
                                <th>Total Izin</th>
                                <th>Total Ontime</th>
                                <th>Total Telat</th>
                                <th>Total Jam Kerja</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center-style">
                            @foreach ($rekapAbsensi as $rekap)
                                <tr>
                                    <td>{{ $rekap->karyawan->nama }}</td>
                                    <td>{{ $rekap->total_hadir }}</td>
                                    <td>{{ $rekap->total_tidak_hadir }}</td>
                                    <td>{{ $rekap->total_sakit }}</td>
                                    <td>{{ $rekap->total_izin }}</td>
                                    <td>{{ $rekap->total_ontime }}</td>
                                    <td>{{ $rekap->total_telat }}</td>
                                    <td>{{ $rekap->total_jam_kerja }}</td>
                                    <td>
                                        <a class="btn bg-warning text-white"
                                            href="{{ route('rekap_absensi.edit', $rekap) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('rekap_absensi.destroy', $rekap) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-danger text-white btn-delete" type="button"
                                                data-action="{{ route('rekap_absensi.destroy', $rekap) }}">
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
