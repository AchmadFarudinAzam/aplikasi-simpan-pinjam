@extends('admin.layout')

@section('title', 'Tambah Nasabah')

@section('content')
<div class="container">
    <h4>Tambah Nasabah</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.nasabah.store') }}">
        @csrf
        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="jabatan" class="form-control" required>
                <option value="SISWA">SISWA</option>
                <option value="GURU">GURU</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection