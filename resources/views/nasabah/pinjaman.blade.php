@extends('layouts.app')

@section('title', 'Riwayat Pinjaman')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('nasabah.pinjaman.form') }}" class="btn btn-warning mb-3">+ Ajukan Pinjaman Baru</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $p)
                <tr>
                    <td>{{ $p->jenis_pinjaman }}</td>
                    <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td>{{ $p->jangka_waktu }} {{ $p->satuan_waktu }}</td>
                    <td><span class="badge badge-info">{{ $p->status }}</span></td>
                    <a href="{{ route('nasabah.pinjaman.detail', $p->kd) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada pinjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection