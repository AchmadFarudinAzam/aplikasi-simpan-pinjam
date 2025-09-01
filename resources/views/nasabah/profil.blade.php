@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container">
    <h3 class="mb-4">Profil Saya</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $nasabah->nama }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $nasabah->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ $nasabah->telp ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Bergabung</th>
                    <td>{{ date('d M Y', strtotime($nasabah->create_at)) }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('nasabah.profil.edit') }}" class="btn btn-primary">Edit Profil</a>
                <a href="{{ route('nasabah.password.form') }}" class="btn btn-warning">Ganti Password</a>
            </div>
        </div>
    </div>
</div>
@endsection