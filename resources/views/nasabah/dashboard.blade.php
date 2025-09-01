

@extends('layouts.app') <!-- atau layout utama Anda -->

@section('content')
<div class="container p-3" style="background-color: #f8f9fa;">
    <div class="text-white p-3 rounded" style="background-color: #28a745;">
        <h5>Selamat Datang,</h5>
        <h3>{{ $nasabah->nama }}</h3>
    </div>

    <div class="card my-3 shadow-sm" style="background-color: #106EBE; border-radius: 15px;">
        <div class="card-body">
            <p class="card-text text-white mb-0">Saldo Simpanan Pokok</p>
            <h3 class="font-weight-bold text-white">Rp {{ number_format($saldoPokok, 0, ',', '.') }}</h3>
            <p class="mb-0 text-white">Simpanan Wajib Rp </p>
            <a href="#" class="btn btn-success btn-block mt-2">Pengajuan Penarikan Simpanan</a>
        </div>
    </div>

    <div class="card my-3 p-3 shadow-sm">
        <p>Limit Pinjaman</p>
        <h4>Rp {{ number_format($limitPinjaman, 0, ',', '.') }}</h4>
        <p class="mb-0">Pinjaman Terpakai</p>
        <h5 class="text-danger">Rp </h5>

        <div class="row text-center mt-3">
            <div class="col">
                <div class="border rounded p-2">
                    <p class="mb-1">Pinjaman Aktif</p>
                    <strong>{{ $pinjamanAktif }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="border rounded p-2">
                    <p class="mb-1">Pinjaman Lunas</p>
                    <strong>{{ $pinjamanLunas }}</strong>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
