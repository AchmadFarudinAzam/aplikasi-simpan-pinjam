@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">Verifikasi Simpanan Nasabah</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nasabah</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($simpanan as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>
                        @if($item->bukti)
                            <a href="{{ asset('bukti/'.$item->bukti) }}" target="_blank">Lihat</a>
                        @else -
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.simpanan.konfirmasi', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="aksi" value="DITERIMA">
                            <button class="btn btn-success btn-sm">✔</button>
                        </form>
                        <form action="{{ route('admin.simpanan.konfirmasi', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="aksi" value="DITOLAK">
                            <button class="btn btn-danger btn-sm">✖</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Tidak ada simpanan menunggu verifikasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
