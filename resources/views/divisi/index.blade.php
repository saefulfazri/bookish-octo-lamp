@extends('layouts/app')
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
    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Divisi</h1>
        </div>
        <div class="card box-blur mb-4">
            <div class="card-body">
                <div class="table-responsive table-striped">
                    <a href="{{ route('divisi.create') }}" class="btn btn-primary mb-3">Tambahkan data</a>
                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisi as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->divisi }}</td>
                                    <td>
                                        <a class="btn bg-warning text-white" href="{{ route('divisi.edit', $data->id) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('divisi.destroy', $data->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-danger text-white btn-delete" type="button"
                                                data-action="{{ route('divisi.destroy', $data->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
