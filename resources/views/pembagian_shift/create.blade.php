@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Menambah Pembagian Shift</h1>
        <a href="{{ route('pembagian_shift.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>


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


    <div class="box-create card shadow rounded">
        <div class="card-header">
            Nama divisi
        </div>
        <div class="row">
            <div class="col m-3">
                <form method="POST" action="{{ route('pembagian_shift.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <select name="id_karyawan" id="id_karyawan" class="form-control">
                            @foreach ($karyawan as $kar)
                                <option value="{{ $kar->id_karyawan }}">{{ $kar->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bulan_tahun">Bulan dan Tahun</label>
                        <input type="month" name="bulan_tahun" id="bulan_tahun" class="form-control"
                            value="{{ old('bulan_tahun') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Pembagian Shift</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Form untuk menambah data -->
@endsection
