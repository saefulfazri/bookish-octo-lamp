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

    <form class="bg-gradient" action="{{ route('absen.proses_izin') }}" method="POST">
        <img src="{{ asset('img/stylebg/bg-1.png') }}" class="bg-styleimg-1" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (4).png') }}" class="bg-styleimg-2" alt="">
        <img src="{{ asset('img/stylebg/bg-1 (3).png') }}" class="bg-styleimg-3" alt="">
        @csrf
        <div class="container absen text-gray-800">
            <div class="row">
                <div class="col">
                    <h1 class="h1-absen">Input Izin</h1>
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
                        <div class="dropdown1">
                            <label for="id_karyawan">Nama Karyawan</label>
                            <input type="text" name="id_karyawan" id="search_karyawan" class="form-control input-tema"
                                placeholder="Cari nama karyawan..." onkeyup="filterDropdown()">
                            <div id="dropdown_list" class="dropdown-menu">
                                @foreach ($karyawan as $kar)
                                    <a href="#" class="dropdown-item"
                                        data-value="{{ $kar->id_karyawan }}">{{ $kar->nama }}</a>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="id_karyawan" id="selected_karyawan"
                            value="{{ request('nama_karyawan') }}">
{{--
                        <select name="id_karyawan" id="id_karyawan" class="form-control input-tema" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach ($karyawan as $k)
                                <option value="{{ $k->id_karyawan }}">{{ $k->nama }}</option>
                            @endforeach
                        </select> --}}

                    </div>
                    <div class="mb-3">
                        <label for="status_hadir">Status Hadir</label>
                        <select name="status_hadir" id="status_hadir" class="form-control input-tema" required>
                            <option class="costum-option" value="Izin">Izin</option>
                            <option class="costum-option" value="Sakit">Sakit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_hari_hadir">Jumlah Hari Hadir</label>
                        <input type="number" name="jumlah_hari_hadir" id="jumlah_hari_hadir"
                            class="form-control input-tema" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control input-tema text-white" rows="4"
                            placeholder="Keterangan untuk semua hari izin"></textarea>
                    </div>
                    <button type="submit" class="form-control btn btn-tema">Simpan</button>

                    <p class="text-white text-center mt-3">Jika ada Kesalahan tidak terduga. Untuk bantuan, silakan klik
                        <a href="youtube.com">link</a> ini
                    </p>
                </div>
            </div>
        </div>
    </form>


    <script>
        function filterDropdown() {
            var input, filter, menu, items, i;
            input = document.getElementById('search_karyawan');
            filter = input.value.toUpperCase();
            menu = document.getElementById('dropdown_list');
            items = menu.getElementsByClassName('dropdown-item');

            menu.style.display = filter ? 'block' : 'none';

            for (i = 0; i < items.length; i++) {
                txtValue = items[i].textContent || items[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        document.addEventListener('click', function(event) {
            var input = document.getElementById('search_karyawan');
            var menu = document.getElementById('dropdown_list');
            var selected = document.getElementById('selected_karyawan');

            if (event.target.classList.contains('dropdown-item')) {
                input.value = event.target.textContent;
                selected.value = event.target.getAttribute('data-value');
                menu.style.display = 'none';
            } else if (!input.contains(event.target)) {
                menu.style.display = 'none';
            }
        });

        document.getElementById('search_karyawan').addEventListener('focus', function() {
            document.getElementById('dropdown_list').style.display = 'block';
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
