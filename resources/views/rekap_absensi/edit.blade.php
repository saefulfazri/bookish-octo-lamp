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
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Edit Rekap Absensi</h1>
        <a href="{{ route('rekap_absensi.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            Nama karyawan <strong>{{ $rekapAbsensi->karyawan->nama }}</strong>
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('rekap_absensi.update', $rekapAbsensi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="total_hadir">Total Hadir</label>
                        <input type="number" class="form-control @error('total_hadir') is-invalid @enderror"
                            id="total_hadir" name="total_hadir" value="{{ $rekapAbsensi->total_hadir }}" required>
                        @error('total_hadir')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_tidak_hadir">total Tidak Hadir</label>
                        <input type="number" class="form-control @error('total_tidak_hadir') is-invalid @enderror"
                            id="total_tidak_hadir" name="total_tidak_hadir"
                            value="{{ old('total_tidak_hadir', $rekapAbsensi->total_tidak_hadir) }}" required>
                        @error('total_tidak_hadir')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_sakit">Total Sakit</label>
                        <input type="number" class="form-control @error('total_sakit') is-invalid @enderror"
                            id="total_sakit" name="total_sakit" value="{{ old('total_sakit', $rekapAbsensi->total_sakit) }}"
                            required>
                        @error('total_sakit')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_izin">Total Izin</label>
                        <input type="number" class="form-control @error('total_izin') is-invalid @enderror" id="total_izin"
                            name="total_izin" value="{{ old('total_izin', $rekapAbsensi->total_izin) }}" required>
                        @error('total_izin')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_ontime">Total Ontime</label>
                        <input type="number" class="form-control @error('total_ontime') is-invalid @enderror"
                            id="total_ontime" name="total_ontime"
                            value="{{ old('total_ontime', $rekapAbsensi->total_ontime) }}" required>
                        @error('total_ontime')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_telat">Total Telat</label>
                        <input type="number" class="form-control @error('total_telat') is-invalid @enderror"
                            id="total_telat" name="total_telat"
                            value="{{ old('total_telat', $rekapAbsensi->total_telat) }}" required>
                        @error('total_telat')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_jam_kerja">Total Jam Kerja</label>
                        <input type="time" class="form-control @error('total_jam_kerja') is-invalid @enderror"
                            id="total_jam_kerja" name="total_jam_kerja"
                            value="{{ old('total_jam_kerja', $rekapAbsensi->total_jam_kerja) }}" required>
                        @error('total_jam_kerja')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection




