@extends('layouts/app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="javascript:history.back()" class="btn bg-danger text-white">back</a>
        </div>
        <div class="container-edit-add">
            <form action="{{ route('absensi.store') }}" method="POST" class="row box-edit-add g-3">
                @csrf
                <div class="col-12 mb-3">
                    <label for="barcode">Barcode Karyawan</label>
                    <input type="text" id="barcode" name="barcode" class="form-control" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="tanggal_hadir">Tanggal Hadir</label>
                    <input type="date" id="tanggal_hadir" name="tanggal_hadir" class="form-control" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
