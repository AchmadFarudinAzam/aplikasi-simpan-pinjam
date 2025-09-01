@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Laporan Pinjaman</div>
    <div class="card-body">
        <a href="{{ route('admin.laporan.pinjaman.pdf') }}" class="btn btn-danger" target="_blank">
            Export PDF
        </a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nasabah</th>
                    <th>Jenis Pinjaman</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjaman as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_pinjaman }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
