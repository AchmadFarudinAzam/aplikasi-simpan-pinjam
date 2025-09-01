@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Profil</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('nasabah.profil.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $nasabah->nama }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ $nasabah->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label for="telp">Nomor Telepon</label>
            <input type="text" name="telp" class="form-control" value="{{ $nasabah->telp }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('nasabah.profil') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
