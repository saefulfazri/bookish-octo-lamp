@extends('layouts/app')
@section('content')
    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> Ada kesalahan pada inputan Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box-create card shadow rounded">
        <div class="card-header">
           Nama karyawan
        </div>
        <div class="row">
            <div class="col m-3">
                <form method="POST" action="{{ route('karyawan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}"
                            required>
                    </div>
                    <div class="form-group d-flex">
                        <label for="jenis_kelamin" class="form-label mr-3">Jenis kelamin :</label>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_pria"
                                value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kelamin_pria">Pria</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_wanita"
                                value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kelamin_wanita">Wanita</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                id="jenis_kelamin_tidak_diketahui" value="Tidak Diketahui"
                                {{ old('jenis_kelamin') == 'Tidak Diketahui' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kelamin_tidak_diketahui">Tidak Diketahui</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal lahir</label>
                        <div class="input-group date" id="datepicker">
                            <input type="date" name="tanggal_lahir" class="form-control" id="date"
                                value="{{ old('tanggal_lahir') }}" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan_terakhir" class="form-label">pendidikan terakhir</label>
                        <input type="text" class="form-control" name="pendidikan_terakhir"
                            value="{{ old('pendidikan_terakhir') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor" class="form-label">nomor</label>
                        <input type="number" class="form-control" name="nomor" value="{{ old('nomor') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="mulai_bekerja">mulai kerja</label>
                        <div class="input-group date" id="datepicker">
                            <input type="date" class="form-control" id="date" name="mulai_bekerja"
                                value="{{ old('mulai_bekerja') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option value="">Pilih jabatan</option>
                            @foreach ($jabatan as $d)
                                <option value="{{ $d->nama_jabatan }}">
                                    {{ $d->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" id="divisi" class="form-control" required>
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $d)
                                <option value="{{ $d->divisi }}" {{ old('divisi') == $d->divisi ? 'selected' : '' }}>
                                    {{ $d->divisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                    <a class="btn btn-danger" href="{{ route('karyawan.index') }}">batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
