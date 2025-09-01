@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">Bayar Angsuran</div>
  <div class="card-body">
    <form method="POST" action="{{ route('nasabah.bayar.proses', $angsuran->id) }}" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Nominal</label>
        <input type="text" readonly class="form-control" value="Rp {{ number_format($angsuran->jumlah_pokok, 0, ',', '.') }}">
      </div>

      <div class="form-group">
        <label>Upload Bukti Pembayaran</label>
        <input type="file" name="bukti" class="form-control" required>
      </div>

      <button class="btn btn-primary" type="submit">Kirim Pembayaran</button>
    </form>
  </div>
</div>
@endsection
