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
        <h2>Edit absensi </h2>

    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            Edit absensi
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('history_absensi.update', $historyAbsensi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <input type="text" name="id_karyawan" id="id_karyawan" class="form-control"
                            value="{{ $karyawan->nama }}" readonly>
                        <input type="hidden" name="id_karyawan" value="{{ $historyAbsensi->id_karyawan }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_hadir">Tanggal Hadir</label>
                        <input type="date" name="tanggal_hadir" id="tanggal_hadir" class="form-control"
                            value="{{ old('tanggal_hadir', $historyAbsensi->tanggal_hadir) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jam_masuk">Jam Masuk</label>
                        <input type="time" name="jam_masuk" id="jam_masuk" class="form-control"
                            value="{{ old('jam_masuk', $historyAbsensi->jam_masuk) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jam_keluar">Jam Keluar</label>
                        <input type="time" name="jam_keluar" id="jam_keluar" class="form-control"
                            value="{{ old('jam_keluar', $historyAbsensi->jam_keluar) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status_hadir">Status Hadir</label>
                        <select name="status_hadir" id="status_hadir" class="form-control" required>
                            <option value="Hadir" {{ $historyAbsensi->status_hadir == 'Hadir' ? 'selected' : '' }}>Hadir
                            </option>
                            <option value="Sakit" {{ $historyAbsensi->status_hadir == 'Sakit' ? 'selected' : '' }}>Sakit
                            </option>
                            <option value="Izin" {{ $historyAbsensi->status_hadir == 'Izin' ? 'selected' : '' }}>Izin
                            </option>
                            <option value="Tidak Hadir"
                                {{ $historyAbsensi->status_hadir == 'Tidak Hadir' ? 'selected' : '' }}>
                                Tidak Hadir</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alasan_tidak_masuk">Alasan Tidak Masuk</label>
                        <input type="text" name="alasan_tidak_masuk" id="alasan_tidak_masuk" class="form-control"
                            value="{{ old('alasan_tidak_masuk', $historyAbsensi->alasan_tidak_masuk) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('history_absensi.index') }}" class="btn text-white bg-danger">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
