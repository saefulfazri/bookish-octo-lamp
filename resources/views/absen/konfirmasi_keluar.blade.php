<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Karyawan</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('path/to/font-awesome/css/font-awesome.min.css') }}">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="{{ asset('css/custom-css.css') }}">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="scrol-mati">

    <form class="bg-gradient" action="{{ route('absen.konfirmasi_keluar') }}" method="POST">
        <img src="{{ asset('img/stylebg/bg-1.png') }}" class="bg-styleimg-1" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (4).png') }}" class="bg-styleimg-2" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (3).png') }}" class="bg-styleimg-3" alt="">
        @csrf
        <div class="container absen text-gray-800">
            <div class="row">
                <div class="col">
                    <h1 class="h1-absen">Kehadiran</h1>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <input type="hidden" name="id_karyawan" value="{{ $idKaryawan }}">
                    <input type="hidden" name="tanggal_hadir" value="{{ $tanggalHadir }}">
                    <input type="hidden" name="waktu_masuk" value="{{ $waktuMasuk }}">
                    <div class="mb-3">
                        <label for="status_hadir">Kehadiran</label>
                        <select name="status_hadir" id="status_hadir" class="form-control input-tema" required>
                            <option class="costum-option" value="Izin" selected>Izin</option>
                            <option class="costum-option" value="Sakit">Sakit</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control input-tema"
                            placeholder="Isi keterangan jika diperlukan">
                    </div>
                    <button type="submit" class=" form-control btn btn-tema">Simpan</button>


                    <p class="text-white text-center mt-3">Jika ada Kesalahan tidak terduga. Untuk bantuan, silakan klik
                        <a href="youtube.com">link</a> ini
                    </p>
                </div>
            </div>
        </div>
    </form>


    <script></script>
    <!-- Bootstrap core JavaScript-->

    <script src=" {{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>


</body>

</html>
