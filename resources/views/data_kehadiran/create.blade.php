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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data kehadiran <i
                class="fa-solid fa-arrow-right pl-2 mr-2"></i>menambahkan kehadiran </h1>
        <a href="{{ route('data_kehadiran.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            menambahkan data
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('data_kehadiran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <select name="id_karyawan" id="id_karyawan" class="form-control">
                            @foreach ($karyawan as $karyawan)
                                <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_hadir">Tanggal Hadir</label>
                        <input type="date" name="tanggal_hadir" id="tanggal_hadir" class="form-control"
                            value="{{ old('tanggal_hadir') }}">
                    </div>
                    <div class="form-group">
                        <label for="waktu_masuk">Waktu Masuk</label>
                        <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control"
                            value="{{ old('waktu_masuk') }}">
                    </div>
                    <div class="form-group">
                        <label for="waktu_keluar">Waktu Keluar</label>
                        <input type="time" name="waktu_keluar" id="waktu_keluar" class="form-control"
                            value="{{ old('waktu_keluar') }}">
                    </div>
                    <div class="form-group">
                        <label for="ketepatan_waktu">Ketepatan Waktu</label>
                        <select name="ketepatan_waktu" id="ketepatan_waktu" class="form-control">
                            <option value="">Pilih</option>
                            <option value="On Time">On Time</option>
                            <option value="Telat">Telat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_hadir">Status Hadir</label>
                        <select name="status_hadir" id="status_hadir" class="form-control">
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
