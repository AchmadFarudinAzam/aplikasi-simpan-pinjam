<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Simpanan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Riwayat Simpanan Nasabah</h2>
    <table>
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
            @foreach($data as $a)
            <tr>
                <td>{{ $a->jenis }}</td>
                <td>Rp {{ number_format($a->nominal,0,',','.') }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
