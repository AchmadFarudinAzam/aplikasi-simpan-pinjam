@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">Laporan Simpanan</div>
    <div class="card-body">
        <a href="{{ route('admin.laporan.simpanan.pdf') }}" class="btn btn-danger" target="_blank">
            Export PDF
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nasabah</th>
                    <th>Jenis Simpanan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($simpanan as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
