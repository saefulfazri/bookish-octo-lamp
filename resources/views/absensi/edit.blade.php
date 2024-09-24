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
    <a href="{{ route('absensi.index') }}" class="btn bg-danger text-white">back</a>

    <div class="container">
        <h2>Edit Absensi</h2>


        <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tanggal_hadir">Tanggal Hadir</label>
                <input type="date" name="tanggal_hadir" id="tanggal_hadir" class="form-control"
                    value="{{ old('tanggal_hadir', $absensi->tanggal_hadir) }}" required>
            </div>

            <div class="form-group">
                <label for="jam_masuk">Jam Masuk</label>
                <input type="time" name="jam_masuk" id="jam_masuk" class="form-control"
                    value="{{ old('jam_masuk', $absensi->jam_masuk) }}" required>
            </div>

            <div class="form-group">
                <label for="jam_keluar">Jam Keluar</label>
                <input type="time" name="jam_keluar" id="jam_keluar" class="form-control"
                    value="{{ old('jam_keluar', $absensi->jam_keluar) }}">
            </div>

            <div class="form-group">
                <label for="alasan_tidak_masuk">Alasan Tidak Masuk</label>
                <textarea name="alasan_tidak_masuk" id="alasan_tidak_masuk" class="form-control">{{ old('alasan_tidak_masuk', $absensi->alasan_tidak_masuk) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status_hadir">Status Hadir</label>
                <select name="status_hadir" id="status_hadir" class="form-control" required>
                    <option value="Hadir" {{ $absensi->status_hadir == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Sakit" {{ $absensi->status_hadir == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Izin" {{ $absensi->status_hadir == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Tidak Hadir" {{ $absensi->status_hadir == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
