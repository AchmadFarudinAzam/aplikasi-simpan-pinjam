@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Riwayat Simpanan</div>
    <div class="card-body">
        <a href="{{ route('nasabah.simpanan.pdf') }}" class="btn btn-danger mb-3" target="_blank">
            Download PDF
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('nasabah.simpanan.tambah') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <select name="jenis" class="form-control" required>
                        <option value="">Pilih Jenis</option>
                        <option value="wajib">Wajib</option>
                        <option value="sukarela">Sukarela</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="nominal" class="form-control" placeholder="Nominal" required>
                </div>
                <div class="col-md-3">
                    <input type="file" name="bukti" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100">Ajukan Simpanan</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $a)
                <tr>
                    <td>{{ ucfirst($a->jenis) }}</td>
                    <td>Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                    <td>{{ $a->tanggal }}</td>
                    <td>
                        @if($a->status == 'DITERIMA')
                            <span class="badge bg-success">DITERIMA</span>
                        @elseif($a->status == 'DITOLAK')
                            <span class="badge bg-danger">DITOLAK</span>
                        @else
                            <span class="badge bg-warning text-dark">MENUNGGU</span>
                        @endif
                    </td>
                    <td>
                        @if($a->bukti)
                            <a href="{{ asset('bukti/'.$item->bukti) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada simpanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
