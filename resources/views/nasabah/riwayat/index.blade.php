@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">Riwayat Pembayaran Angsuran</div>
    <div class="card-body">
        <a href="{{ route('nasabah.pinjaman.pdf') }}" class="btn btn-danger mb-3" target="_blank">
            Download PDF
        </a>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Angsuran Ke</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Bayar</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($angsuran as $a)
                    <tr>
                        <td>{{ $a->ke }}</td>
                        <td>Rp {{ number_format($a->jumlah_pokok, 0, ',', '.') }}</td>
                        <td>
                            @if ($a->status === 'SUDAH')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum</span>
                            @endif
                        </td>
                        <td>{{ $a->tanggal_bayar ?? '-' }}</td>
                        <td>
                            @if ($a->bukti_pembayaran)
                                <a href="{{ asset('bukti/' . $a->bukti_pembayaran) }}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Belum ada pembayaran</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
