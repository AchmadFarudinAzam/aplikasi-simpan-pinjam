@extends('layouts.app')

@section('title', 'Tabungan')

@section('content')
<div class="container py-4">
    <h4>Riwayat Tabungan</h4>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Tipe</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>{{ ucfirst($row->tipe) }}</td>
                <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada transaksi tabungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection