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

    <style>

    </style>
</head>

<body>

    <div class="container absen text-gray-800">
        <div class="row justify-content-center">
            <div class="p-3">
                <h1 class="h1-absen">Absensi Karyawan</h1>

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

                <form action="{{ route('absen_karyawan.store_izin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_karyawan">ID Karyawan</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan"
                            placeholder="Masukkan ID Karyawan" required>
                        @error('id_karyawan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="alasan_izin">Alasan Izin</label>
                        <textarea class="form-control" id="alasan_izin" name="alasan_tidak_masuk" rows="3"
                            placeholder="Masukkan alasan izin" required></textarea>
                        @error('alasan_tidak_masuk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_hadir">Status Hadir</label>
                        <select id="status_hadir" name="status_hadir" class="form-control" required>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                        @error('status_hadir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary col">Kirim</button>
                    </div>
                </form>

                <p class="text-center">Jika ada kesalahan tidak terduga, silakan klik
                    <a href="https://www.youtube.com">link ini</a> untuk bantuan.
                </p>

            </div>
        </div>
    </div>

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
