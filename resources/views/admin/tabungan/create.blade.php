@extends('admin.layout')

@section('title', 'Tambah Tabungan')

@section('content')
<div class="container">
    <h4>Tambah Transaksi Tabungan</h4>

    <form method="POST" action="{{ route('admin.tabungan.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nasabah</label>
            <select name="pelanggan_kd" class="form-control" required>
                @foreach($nasabah as $n)
                <option value="{{ $n->kd }}">{{ $n->nama }} ({{ $n->kode }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
                <option value="debet">Debet (Setoran)</option>
                <option value="kredit">Kredit (Penarikan)</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection