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
        <h2>Tambah Pengguna Baru</h2>
        <a href="{{ route('users.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            pengguna baru
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password:</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Masukan password ulang" required>
                    </div>
                    <div class="form_group">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                            required>
                            <option value="admin">Admin</option>
                            <option value="Moderator">Moderator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
