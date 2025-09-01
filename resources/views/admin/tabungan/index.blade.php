@extends('admin.layout')

@section('title', 'Riwayat Tabungan')

@section('content')
<div class="container">
    <h4>Riwayat Tabungan</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.tabungan.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Tipe</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->tanggal }}</td>
                <td>{{ $row->nasabah->nama ?? '-' }}</td>
                <td>{{ ucfirst($row->tipe) }}</td>
                <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                <td>{{ $row->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection