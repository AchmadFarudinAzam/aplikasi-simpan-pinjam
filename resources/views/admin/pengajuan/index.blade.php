@extends('admin.layout') {{-- Sesuaikan dengan layout adminmu --}}

@section('content')
<div class="container mt-4">
    <h4>Daftar Pengajuan Pinjaman</h4>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Nasabah</th>
                <th>Jenis Pinjaman</th>
                <th>Nominal</th>
                <th>Tenor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuan as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis_pinjaman }}</td>
                    <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td>{{ $p->jangka_waktu }} {{ $p->satuan_waktu }}</td>
                    <td>
                        <span class="badge 
                            @if($p->status == 'MENUNGGU') badge-warning
                            @elseif($p->status == 'DISETUJUI') badge-success
                            @else badge-danger
                            @endif">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>
                        @if ($p->status == 'MENUNGGU')
                        <form action="{{ route('admin.pengajuan.konfirmasi', $p->kd) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="DISETUJUI">
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                        </form>

                        <form action="{{ route('admin.pengajuan.konfirmasi', $p->kd) }}" method="POST" class="mt-1">
                            @csrf
                            <input type="hidden" name="status" value="DITOLAK">
                            <div class="input-group">
                                <input type="text" name="catatan_admin" class="form-control" placeholder="Alasan..." required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.pengajuan.konfirmasi', $p->kd) }}">
                            @csrf
                            <select name="status" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="DISETUJUI">Setujui</option>
                                <option value="DITOLAK">Tolak</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-1">Proses</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada pengajuan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
