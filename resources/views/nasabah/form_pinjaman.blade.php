@extends('layouts.app')

@section('title', '')

@section('content')
<div class="container mt-4">
    <h4>Form Pengajuan Pinjaman</h4>

    <form action="{{ route('nasabah.pinjaman.ajukan') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Jenis Pinjaman</label>
            <select name="jenis_pinjaman" class="form-control" required>
                <option value="">Pilih Jenis</option>
                <option value="Modal Usaha">Modal Usaha</option>
                <option value="Kebutuhan Rumah">Kebutuhan Rumah</option>
            </select>
        </div>

        <div class="form-group">
            <label>Peruntukan</label>
            <select name="peruntukan" class="form-control" required>
                <option value="">Pilih Peruntukan</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Renovasi">Renovasi</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label>Jangka Waktu</label>
                <input type="number" name="jangka_waktu" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label>Satuan</label>
                <select name="satuan_waktu" class="form-control" required>
                    <option value="HARI">Hari</option>
                    <option value="BULAN">Bulan</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Jatuh Tempo Tanggal</label>
            <input type="number" name="jatuh_tempo_tanggal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan</button>
        <a href="{{ route('nasabah.pinjaman') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection