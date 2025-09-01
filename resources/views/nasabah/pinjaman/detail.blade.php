@extends('layouts.app')

@section('title', 'Riwayat Pinjaman')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail Pinjaman</h4>
    </div>
    <div class="card-body">
        <h5>{{ $pinjaman->jenis_pinjaman }} - {{ $pinjaman->peruntukan }}</h5>
        <p><strong>Nominal:</strong> Rp {{ number_format($pinjaman->nominal, 0, ',', '.') }}</p>
        <p><strong>Tenor:</strong> {{ $pinjaman->jangka_waktu }} {{ $pinjaman->satuan_waktu }}</p>
        <p><strong>Status:</strong> {{ $pinjaman->status }}</p>

        <hr>

        <h5>✅ Angsuran Terbayar</h5>
        {{--<ul>
            @foreach ($angsuranLunas as $pinjaman)
                <li>
                    #{{ $pinjaman->ke }} - Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }} ({{ $pinjaman->tanggal_bayar }})
                </li>
            @endforeach
        </ul>--}}
        {{-- Angsuran Terbayar --}}
        <div class="card-angsuran angsuran-terbayar">
            <div class="angsuran-header">✅ Angsuran Terbayar</div>
            @forelse ($angsuranLunas->where('status', 'SUDAH') as $pinjaman)
            <div class="angsuran-row">
                <div>Angsuran ke-{{ $pinjaman->ke }} — Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</div>
                    <span class="badge-status badge-sudah">Lunas</span>
                </div>
            @empty
            <p><em>Belum ada angsuran dibayar.</em></p>
            @endforelse
        </div>

        <h5>📅 Angsuran Akan Datang</h5>
        {{--<ul>
            @foreach ($angsuranBelum as $pinjaman)
            <tr>
                <td>Angsuran ke-{{ $pinjaman->ke }}</td>
                <td>Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</td>
                <td>{{ $pinjaman->status }}</td>
                <td>
                    @if ($pinjaman->status === 'BELUM')
                        <a href="{{ route('nasabah.bayar.form', $pinjaman->id) }}" class="btn btn-sm btn-success">Bayar</a>
                    @else
                    Sudah dibayar
                    @endif
                </td>
            </tr>
            @endforeach
        </ul>--}}
        {{-- Angsuran Akan Datang --}}
        <div class="card-angsuran angsuran-belum">
            <div class="angsuran-header">⏳ Angsuran Akan Datang</div>
            @forelse ($angsuranBelum->where('status', 'BELUM') as $pinjaman)
            <div class="angsuran-row">
                <div>Angsuran ke-{{ $pinjaman->ke }} — Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</div>
                    <a href="{{ route('nasabah.bayar.form', $pinjaman->id) }}" class="btn-bayar">Bayar</a>
                </div>
            @empty
            <p><em>Semua angsuran telah dibayar.</em></p>
            @endforelse
        </div>
    </div>
</div>
@endsection