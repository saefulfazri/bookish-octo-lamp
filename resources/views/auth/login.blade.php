<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <form class="bg-gradient" method="POST" action="{{ route('login') }}">
        <img src="{{ asset('img/stylebg/bg-1.png') }}" class="bg-styleimg-1" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (4).png') }}" class="bg-styleimg-2" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (3).png') }}" class="bg-styleimg-3" alt="">
        @csrf
        <div class="container absen text-gray-800">
            <div class="row ">
                <div class="col">

                    <h1 class="h1-absen">Login Admin</h1>
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
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control input-tema" required>

                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control input-tema" required>
                        <div class="mt-2">
                            <input type="checkbox" id="showPassword" onclick="togglePassword()">
                            <label for="showPassword" class="text-white">Show Password</label>
                        </div>
                    </div>
                    <button type="submit" class="form-control btn-tema mb-3">Login</button>

                    <p class="text-white text-center">Jika ada Kesalahan tidak terduga. Untuk bantuan, silakan klik
                        <a href="youtube.com">link</a> ini
                    </p>
                </div>
            </div>
            <p>Copyright © 2024 Absensi-by_saefulfazri. All Rights Reserved.</p>
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