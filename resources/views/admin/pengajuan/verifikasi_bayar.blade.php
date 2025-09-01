@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header">Verifikasi Pembayaran Angsuran</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nasabah</th>
                    <th>Jenis Pinjaman</th>
                    <th>Angsuran Ke</th>
                    <th>Nominal</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($angsuran as $pinjaman)
                <tr>
                    <td>{{ $pinjaman->nama }}</td>
                    <td>{{ $pinjaman->jenis_pinjaman }}</td>
                    <td>{{ $pinjaman->ke }}</td>
                    <td>Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</td>
                    <td>
                        @if ($pinjaman->bukti_pembayaran)
                            <a href="{{ asset('bukti/' . $pinjaman->bukti_pembayaran) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.pengajuan.konfirmasi', $pinjaman->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="aksi" value="DITERIMA">
                            <button class="btn btn-success btn-sm" onclick="return confirm('Terima pembayaran ini?')">✔</button>
                        </form>

                        <form method="POST" action="{{ route('admin.pengajuan.konfirmasi', $pinjaman->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="aksi" value="DITOLAK">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">✖</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pembayaran menunggu verifikasi.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection