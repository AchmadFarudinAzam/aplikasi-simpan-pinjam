@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Row Info Boxes -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box total simpanan -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h3>
                    <p>Total Simpanan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box total pinjaman -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</h3>
                    <p>Total Pinjaman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box nasabah baru -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $nasabahBaru }} <sup style="font-size: 20px">baru</sup></h3>
                    <p>Nasabah Terdaftar Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box setoran terakhir -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp </h3>
                    <p>Setoran Terakhir</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coins"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Charts -->
    <div class="row">
        <div class="col-md-6">
            <!-- BAR Chart -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Pinjaman per Jenis</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartPinjaman" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- PIE Chart -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Simpanan per Bulan</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartSimpanan" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Tables -->
    <div class="row">
        <div class="col-md-6">
            <!-- Tabel Pinjaman -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Pinjaman</h3>
                </div>
                <div class="card-body table-responsive p-0" style="max-height: 250px;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjaman as $row)
                            <tr>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->jenis_pinjaman }}</td>
                                <td><span class="badge badge-{{ $row->status == 'DISETUJUI' ? 'success' : 'danger' }}">{{ $row->status }}</span></td>
                                <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Tabel Simpanan -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Simpanan</h3>
                </div>
                <div class="card-body table-responsive p-0" style="max-height: 250px;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pokok</th>
                                <th>Wajib</th>
                                <th>Sukarela</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($simpanan as $row)
                            <tr>
                                <td>{{ $row->nama }}</td>
                                <td>Rp {{ number_format($row->pokok, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($row->wajib, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($row->sukarela, 0, ',', '.') }}</td>
                                <td><strong>Rp {{ number_format($row->total, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log('Labels:', {!! json_encode($labelPinjaman) !!});
    console.log('Data:', {!! json_encode($dataPinjaman) !!});
    const chartPinjaman = new Chart(document.getElementById('chartPinjaman'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($labelPinjaman) !!},
        datasets: [{
            label: 'Total Pinjaman',
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            data: {!! json_encode($dataPinjaman) !!}
        }]
    }
});

const chartSimpanan = new Chart(document.getElementById('chartSimpanan'), {
    type: 'line',
    data: {
        labels: {!! json_encode($labelSimpanan) !!},
        datasets: [{
            label: 'Total Simpanan',
            backgroundColor: 'rgba(75, 192, 192, 0.4)',
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: true,
            data: {!! json_encode($dataSimpanan) !!}
        }]
    }
});
</script>
@endpush
