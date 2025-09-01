<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kode</th>
            <th>Total Pinjaman</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $n)
        <tr>
            <td>{{ $n->nama }}</td>
            <td>{{ $n->kode }}</td>
            <td>{{ $n->pinjaman->sum('nominal') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>