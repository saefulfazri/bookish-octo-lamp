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


    <form action="{{ route('absen_karyawan.handle_action') }}" method="POST">
        @csrf
        <div class="container absen text-gray-800">
            <div class="row">
                <div class="col">
                    <h1 class="h1-absen">Mengingatkan</h1>
                    <div class="alert alert-info">
                        <strong>{{ $prompt['message'] }}</strong>
                    </div>
                    <input type="hidden" name="id_karyawan" value="{{ $prompt['karyawan']->id_karyawan }}">
                    <input type="hidden" name="id_absensi" value="{{ $prompt['absensi']->id }}">
                    <div class="form-group">
                        <label for="action">Pilih:</label>
                        <select name="action" id="action" class="form-control" required>
                            <option value="keluar">Keluar</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Alasan</label>
                        <textarea class="form-control" name="alasan" id="alasan" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary col">Kirim</button>
                    </div>
                    <p class="text-white text-center">Jika ada Kesalahan tidak terduga. Untuk bantuan, silakan klik
                        <a href="youtube.com">link</a> ini
                    </p>
                </div>

            </div>
        </div>
    </form>

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
