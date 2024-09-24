@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
    <!-- Filter Status -->
    @if ($filtersApplied)
        <div class="alert alert-info mt-3">
            <strong>Filter diterapkan:</strong>
            <ul>
                @if (request('nama_karyawan'))
                    <li>Nama Karyawan : {{ request('nama_karyawan') }}</li>
                @endif
                @if (request('bulan_tahun'))
                    <li>Tanggal : {{ request('bulan_tahun') }}</li>
                @endif
            </ul>
        </div>
    @endif



    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Daftar Pembagian Shift</h1>
            <form method="GET" class="d-flex" action="{{ route('pembagian_shift.index') }}">

                <div class="mr-1">
                    <input type="month" name="bulan_tahun" id="bulan_tahun" class="form-control"
                        value="{{ request('bulan_tahun') }}">
                </div>


                <div class="mr-1">
                    <div class="dropdown">
                        <input type="text" id="search_karyawan" class="form-control" placeholder="Cari nama karyawan..."
                            onkeyup="filterDropdown()">
                        <div id="dropdown_list" class="dropdown-menu">
                            @foreach ($karyawan as $kar)
                                <a href="#" class="dropdown-item"
                                    data-value="{{ $kar->nama }}">{{ $kar->nama }}</a>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="nama_karyawan" id="selected_karyawan"
                        value="{{ request('nama_karyawan') }}">
                </div>

                <button type="submit" class="btn btn-primary">Mencari</button>
                <a href="{{ route('pembagian_shift.create') }}" class="btn ml-1 text-white bg-info">
                    pembagian shift
                </a>
            </form>

        </div>
        <form method="POST" action="{{ route('pembagian_shift.update_all') }}">
            @csrf
            @method('POST') <!-- Atau @method('PATCH') jika menggunakan PATCH method -->
            <div class="card box-blur mb-4">
                <div class="card-body">
                    <div class="table-responsive table-striped">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Shift</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>


                            </thead>
                            <tbody>
                                @if ($filtersApplied)
                                    @forelse($pembagianShifts as $shift)
                                        <tr data-id="{{ $shift->id }}">
                                            <td>{{ $shift->karyawan->nama }}</td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="shifts[{{ $shift->id }}][hari]"
                                                    value="{{ old('shifts.' . $shift->id . '.hari', $shift->hari) }}"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control"
                                                    name="shifts[{{ $shift->id }}][tanggal]"
                                                    value="{{ old('shifts.' . $shift->id . '.tanggal', $shift->tanggal) }}"
                                                    readonly>
                                            </td>
                                            <td>
                                                <select class="form-control shift-select"
                                                    name="shifts[{{ $shift->id }}][shift_id]">
                                                    <option value="">Libur</option>
                                                    @foreach ($shifts as $shiftOption)
                                                        <option value="{{ $shiftOption->id }}"
                                                            {{ $shift->shift_id == $shiftOption->id ? 'selected' : '' }}
                                                            data-jam-mulai="{{ $shiftOption->jam_mulai ? date('H:i', strtotime($shiftOption->jam_mulai)) : '' }}"
                                                            data-jam-selesai="{{ $shiftOption->jam_selesai ? date('H:i', strtotime($shiftOption->jam_selesai)) : '' }}">
                                                            {{ $shiftOption->nama_shift }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control"
                                                    name="shifts[{{ $shift->id }}][jam_mulai]"
                                                    value="{{ old('shifts.' . $shift->id . '.jam_mulai', $shift->jam_mulai ? date('H:i', strtotime($shift->jam_mulai)) : '') }}"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control"
                                                    name="shifts[{{ $shift->id }}][jam_selesai]"
                                                    value="{{ old('shifts.' . $shift->id . '.jam_selesai', $shift->jam_selesai ? date('H:i', strtotime($shift->jam_selesai)) : '') }}"
                                                    readonly>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Silakan terapkan filter untuk melihat data.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Update Semua</button>
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


            document.querySelectorAll('.shift-select').forEach(select => {
                select.addEventListener('change', function() {
                    const row = this.closest('tr'); // Temukan baris terdekat
                    const shiftId = this.value;
                    const rowId = row.dataset.id; // Ambil ID dari data-id pada baris

                    // Temukan input jam_mulai dan jam_selesai dalam baris
                    const jamMulaiInput = row.querySelector(`input[name="shifts[${rowId}][jam_mulai]"]`);
                    const jamSelesaiInput = row.querySelector(`input[name="shifts[${rowId}][jam_selesai]"]`);

                    if (shiftId) {
                        // Temukan opsi yang sesuai dengan shiftId
                        const option = this.querySelector(`option[value="${shiftId}"]`);
                        if (option) {
                            // Ambil data dari attribute data
                            const jamMulai = option.getAttribute('data-jam-mulai') || '';
                            const jamSelesai = option.getAttribute('data-jam-selesai') || '';

                            // Set nilai input sesuai dengan data
                            jamMulaiInput.value = jamMulai;
                            jamSelesaiInput.value = jamSelesai;
                        } else {
                            // Jika tidak ditemukan opsi yang sesuai, kosongkan input
                            jamMulaiInput.value = '';
                            jamSelesaiInput.value = '';
                        }
                    } else {
                        // Jika tidak ada shiftId, kosongkan input
                        jamMulaiInput.value = '';
                        jamSelesaiInput.value = '';
                    }
                });
            });
        </script>

    </div>
@endsection
