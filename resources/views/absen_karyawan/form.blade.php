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

<body>

    <form action="{{ route('absen_karyawan.store') }}" method="POST" id="absenForm">
        @csrf
        <div class="container absen text-gray-800">
            <div class="row">
                <div class="col">

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="id_karyawan">ID Karyawan</label>
                        <input type="text" name="id_karyawan" id="id_karyawan" class="form-control" required readonly
                            autofocus>
                    </div>
                    <button type="submit" class="form-control btn-primary mb-3">Submit</button>

                    <p class="text-white text-center">Jika ada Kesalahan tidak terduga. Untuk bantuan, silakan klik
                        <a href="youtube.com">link</a> ini
                    </p>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('id_karyawan');
            let barcode = '';
            let barcodeTimer;

            // Event listener to capture the input from barcode scanner
            window.addEventListener('keydown', function(event) {
                // Reset timer on every keypress
                clearTimeout(barcodeTimer);

                // Add character to barcode string
                barcode += event.key;

                // Set a timeout to trigger form submission after 200ms of inactivity
                barcodeTimer = setTimeout(function() {
                    input.value = barcode; // Set the input value to the barcode
                    document.getElementById('absenForm').submit(); // Submit the form automatically
                }, 200); // Adjust the delay as needed based on barcode scanner speed
            });
        });
    </script>

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
