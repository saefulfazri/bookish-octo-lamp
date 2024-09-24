@extends('layouts/app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <div class="row">
        <!-- Total Karyawan -->
        <div class="col-md-3">
            <div class="card box-ds-blur mb-3 text-center shadow">
                <div class="card-header-ds-primary">Total Karyawan</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalKaryawan }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Hadir -->
        <div class="col-md-3">
            <div class="card box-ds-blur  mb-3 text-center shadow">
                <div class="card-header-ds-success"> Hadir ({{ $tanggalTerbaru }})</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalHadir }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Tidak Hadir (termasuk Izin dan Sakit) -->
        <div class="col-md-3">
            <div class="card box-ds-blur mb-3 text-center shadow">
                <div class="card-header-ds-danger"> Tidak Hadir ({{ $tanggalTerbaru }})</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalTidakHadir }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Belum Absen -->
        <div class="col-md-3">
            <div class="card box-ds-blur  mb-3 text-center shadow">
                <div class="card-header-ds-warning "> Belum Absen ({{ $tanggalTerbaru }})</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalBelumAbsen }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="box-blur style-aktif">
                <div class="card-header-ds-warning text-center  text-white">Karyawan Paling Aktif</div>
                <div class="p-3">
                    @if ($karyawanAktif)
                        <table class="box-ds-text">
                            <tbody>
                                <tr>
                                    <td>Nama Karyawan</td>
                                    <td>:</td>
                                    <td>{{ $karyawanAktif->karyawan->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Kehadiran</td>
                                    <td>:</td>
                                    <td>{{ $karyawanAktif->total_hadir }}</td>
                                </tr>
                                <tr>
                                    <td>Jam Kerja</td>
                                    <td>:</td>
                                    <td>{{ gmdate('H:i', $karyawanAktif->total_jam_kerja) }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        <p>Tidak ada data karyawan paling aktif saat ini.</p>
                                    </td>
                                </tr>
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Hadir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalHadirToday }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Tidak hadir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTidakHadirToday }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ke
                                aktifan karyawan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ number_format($keaktifanKaryawan, 2) }}%
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ number_format($keaktifanKaryawan, 2) }}%" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Karyawan Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKaryawan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-address-card fa-2x  text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jam Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">08.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-arrow-right fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                jam keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">17.00</div>
                        </div>
                        <div class="col-auto ">
                            <i class="fa-solid fa-arrow-left fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- sdada -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">karyawan terrajin</h6>
                </div>
                <div class="card-body">
                    @foreach ($terajin as $karyawan)
                        <h4 class="small font-weight-bold">{{ $karyawan->karyawan->nama }}<span class="float-right">
                                {{ round($karyawan->attendancePercentage, 2) }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar {{ $karyawan->bgClass }}" role="progressbar"
                                style="width:  {{ round($karyawan->attendancePercentage, 2) }}%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Apa itu absensi online?</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_join_re_w1lh.svg" alt="...">
                        </div>
                        <p>Absensi adalah proses pencatatan kehadiran seseorang di sekolah, kantor, atau
                            acara. Tujuannya adalah untuk memantau siapa yang hadir atau tidak hadir.
                        </p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">ayoo mariii isiii absensii kamuu
                            &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
