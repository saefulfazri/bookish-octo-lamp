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
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Divisi<i class="fa-solid fa-arrow-right pl-2 mr-2"></i>edit Divisi</h1>
        <a href="{{ route('divisi.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            divisi
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" class="form-control" id="divisi" name="divisi"
                            value="{{ $divisi->divisi }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
