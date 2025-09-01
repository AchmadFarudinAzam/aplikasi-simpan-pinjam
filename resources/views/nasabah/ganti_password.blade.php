@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Ganti Password</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('nasabah.password.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="password_lama">Password Lama</label>
            <input type="password" name="password_lama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_baru">Password Baru</label>
            <input type="password" name="password_baru" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="konfirmasi_password">Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Password</button>
        <a href="{{ route('nasabah.profil') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
