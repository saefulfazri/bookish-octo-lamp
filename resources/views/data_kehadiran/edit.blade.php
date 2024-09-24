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
                class="fa-solid fa-arrow-right pl-2 mr-2"></i>edit kehadiran </h1>
        <a href="{{ route('data_kehadiran.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            <strong>{{ $dataKehadiran->karyawan->nama }}</strong>
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('data_kehadiran.update', $dataKehadiran->id_absensi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <input type="text" name="id_karyawan" id="id_karyawan" class="form-control"
                            value="{{ old('id_karyawan', $dataKehadiran->id_karyawan ?? '') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_hadir">Tanggal Hadir</label>
                        <input type="date" name="tanggal_hadir" id="tanggal_hadir" class="form-control"
                            value="{{ old('tanggal_hadir', $dataKehadiran->tanggal_hadir) }}">
                    </div>
                    <div class="form-group">
                        <label for="waktu_masuk">Waktu Masuk</label>
                        <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control"
                            value="{{ old('waktu_masuk', $dataKehadiran->waktu_masuk ? \Carbon\Carbon::parse($dataKehadiran->waktu_masuk)->format('H:i') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="waktu_keluar">Waktu Keluar</label>
                        <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control"
                            value="{{ old('waktu_keluar', $dataKehadiran->waktu_keluar ? \Carbon\Carbon::parse($dataKehadiran->waktu_keluar)->format('H:i') : '') }}">
                    </div>
                    <div class="form-group">
                        <label for="ketepatan_waktu">Ketepatan Waktu</label>
                        <select name="ketepatan_waktu" id="ketepatan_waktu" class="form-control">
                            <option value="On Time" {{ $dataKehadiran->ketepatan_waktu == 'On Time' ? 'selected' : '' }}>On
                                Time
                            </option>
                            <option value="Telat" {{ $dataKehadiran->ketepatan_waktu == 'Telat' ? 'selected' : '' }}>Telat
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lama_kerja">Lama Kerja</label>
                        <input type="text" name="lama_kerja" id="lama_kerja" class="form-control"
                            value="{{ old('lama_kerja', $dataKehadiran->lama_kerja) }}">
                    </div>
                    <div class="form-group">
                        <label for="status_hadir">Status Hadir</label>
                        <select name="status_hadir" id="status_hadir" class="form-control">
                            <option value="Hadir" {{ $dataKehadiran->status_hadir == 'Hadir' ? 'selected' : '' }}>Hadir
                            </option>
                            <option value="Izin" {{ $dataKehadiran->status_hadir == 'Izin' ? 'selected' : '' }}>Izin
                            </option>
                            <option value="Sakit" {{ $dataKehadiran->status_hadir == 'Sakit' ? 'selected' : '' }}>Sakit
                            </option>
                            <option value="Tidak Hadir"
                                {{ $dataKehadiran->status_hadir == 'Tidak Hadir' ? 'selected' : '' }}>Tidak
                                Hadir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $dataKehadiran->keterangan) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
