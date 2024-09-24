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
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 judul_style"><i class="fa-solid fa-arrow-right pl-2 mr-2"></i>Data Karyawan <i
                class="fa-solid fa-arrow-right pl-2 mr-2"></i>data karyawan personal </h1>
    </div>
    <div class="container_table">
        <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-table">
                <table class="table-personal">
                    <tr>
                        <th>ID-Karyawan</th>
                        <td>:</td>
                        <td><input class="form-control w-c" value="{{ $karyawan->id_karyawan }}" readonly>
                        </td>

                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td><input class="form-control w-c" type="text" name="nama" value="{{ $karyawan->nama }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis kelamin</th>
                        <td>:</td>
                        <td>
                            <select class="form-control w-c" name="jenis_kelamin">
                                <option value="Pria" {{ $karyawan->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria
                                </option>
                                <option value="Wanita" {{ $karyawan->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita
                                </option>
                                <option value="Tidak Diketahui"
                                    {{ $karyawan->jenis_kelamin == 'Tidak Diketahui' ? 'selected' : '' }}>Tidak Diketahui
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>tanggal lahir</th>
                        <td>:</td>
                        <td>
                            <input class="form-control w-c" type="date" name="tanggal_lahir"
                                value="{{ $karyawan->tanggal_lahir }}">
                        </td>
                    </tr>
                    <tr>
                        <th>pendidikan terakhir</th>
                        <td>:</td>
                        <td>
                            <input class="form-control w-c" type="text" name="pendidikan_terakhir"
                                value="{{ $karyawan->pendidikan_terakhir }}">
                        </td>
                    </tr>
                    <tr>
                        <th>alamat</th>
                        <td>:</td>
                        <td><input class="form-control w-c" type="text" name="alamat" value="{{ $karyawan->alamat }}">
                        </td>
                    </tr>
                    <tr>
                        <th>nomor</th>
                        <td>:</td>
                        <td> <input class="form-control w-c" type="text" name="nomor" value="{{ $karyawan->nomor }}">
                        </td>
                    </tr>
                    <tr>
                        <th>mulai bekerja</th>
                        <td>:</td>
                        <td><input class="form-control w-c" type="date" name="mulai_bekerja"
                                value="{{ $karyawan->mulai_bekerja }}"></td>
                    </tr>
                    <tr>
                        <th>jabatan</th>
                        <td>:</td>
                        <td> <select name="jabatan" id="jabatan" class="form-control" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $d)
                                    <option value="{{ $d->nama_jabatan }}"
                                        {{ $karyawan->jabatan == $d->nama_jabatan ? 'selected' : '' }}>
                                        {{ $d->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Status Karyawan</th>
                        <td>:</td>
                        <td>
                            <select name="Status_Karyawan" id="Status_Karyawan" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ $karyawan->Status_Karyawan == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ $karyawan->Status_Karyawan == 'tidak aktif' ? 'selected' : '' }}>tidak aktif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>divisi</th>
                        <td>:</td>
                        <td>
                            <select name="divisi" id="divisi" class="form-control" required>
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisi as $d)
                                    <option value="{{ $d->divisi }}"
                                        {{ $karyawan->divisi == $d->divisi ? 'selected' : '' }}>
                                        {{ $d->divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn bg-primary text-white" type="submit">Update</button>
                            <a class="btn bg-danger text-white" href="javascript:history.back()">Batal</a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
@endsection
