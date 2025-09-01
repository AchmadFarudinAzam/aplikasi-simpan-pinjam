@extends('admin.layout')

@section('title', 'Edit Nasabah')

@section('content')
<div class="container">
    <h4>Edit Nasabah</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.nasabah.update', $nasabah->kd) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ $nasabah->kode }}" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $nasabah->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="jabatan" class="form-control" required>
                <option value="SISWA" {{ $nasabah->jabatan == 'SISWA' ? 'selected' : '' }}>SISWA</option>
                <option value="GURU" {{ $nasabah->jabatan == 'GURU' ? 'selected' : '' }}>GURU</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telp" class="form-control" value="{{ $nasabah->telp }}">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection