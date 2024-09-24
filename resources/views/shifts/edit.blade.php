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
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Shift<i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Mengedit Shift</h1>
        <a href="{{ route('shifts.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            Nama shift
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('shifts.update', $shift->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_shift">Nama Shift</label>
                        <input type="text" class="form-control @error('nama_shift') is-invalid @enderror" id="nama_shift" name="nama_shift" value="{{ old('nama_shift', $shift->nama_shift) }}" required>
                        @error('nama_shift')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jam_mulai">Jam mulai</label>
                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $shift->jam_mulai) }}" required>
                        @error('jam_mulai')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $shift->jam_selesai) }}" required>
                        @error('jam_selesai')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
