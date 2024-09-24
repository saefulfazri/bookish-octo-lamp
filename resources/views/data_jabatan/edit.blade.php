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
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Jabatan<i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Edit Jabatan</h1>
        <a href="{{ route('data_jabatan.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            Nama divisi
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('data_jabatan.update', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control"
                            value="{{ $jabatan->nama_jabatan }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $jabatan->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
