@extends('admin.layout')

@section('title', 'Data Nasabah')

@section('content')
<div class="container">
    <h4>Data Nasabah</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary mb-3">+ Tambah Nasabah</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nasabah as $data)
            <tr>
                <td>{{ $data->kode }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->jabatan }}</td>
                <td>{{ $data->telp }}</td>
                <td>
                    <a href="{{ route('admin.nasabah.edit', $data->kd) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.nasabah.destroy', $data->kd) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection