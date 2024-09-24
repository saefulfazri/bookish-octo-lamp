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
        <h2>Menambah absensi secara manual</h2>

    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            Tambahkan absensi
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('history_absensi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>ID Karyawan</label>
                        <input type="number" name="id_karyawan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Hadir</label>
                        <input type="date" name="tanggal_hadir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Masuk</label>
                        <input type="time" name="jam_masuk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Keluar</label>
                        <input type="time" name="jam_keluar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status Hadir</label>
                        <select name="status_hadir" class="form-control" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alasan_izin">Alasan</label>
                        <textarea class="form-control" name="alasan_tidak_masuk" rows="3" placeholder="Masukkan jika ada alasan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('history_absensi.index') }}" class="btn text-white bg-danger">
                        Batal
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
