<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Pinjaman</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Riwayat Pinjaman Nasabah</h2>
    <table>
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $p)
            <tr>
                <td>{{ $p->jenis_pinjaman }}</td>
                <td>Rp {{ number_format($p->nominal,0,',','.') }}</td>
                <td>{{ $p->jangka_waktu }} {{ $p->satuan_waktu }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
