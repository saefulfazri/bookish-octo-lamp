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

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2>Edit Pengguna</h2>
        <a href="{{ route('users.index') }}" class="btn text-white bg-danger">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
    <div class="box-create card shadow rounded">
        <div class="card-header">
            users {{ $user->name }}
        </div>
        <div class="row">
            <div class="col m-3">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                            placeholder="Masukan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                            placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="Moderator" {{ old('role', $user->role) == 'Moderator' ? 'selected' : '' }}>
                                Moderator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
