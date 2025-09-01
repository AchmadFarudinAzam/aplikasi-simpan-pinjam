<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Nasabah</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #e9ecef;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">

                <div class="card-body">
                    <form action="{{ route('registrasi.create') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="kd">Kode</label>
                            <input type="text" name="kd" class="form-control" placeholder="Kode unik nasabah" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label for="telp">Alamat</label>
                            <input type="text" name="telp" class="form-control" placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Pekerjaan</label>
                            <input type="text" name="jabatan" class="form-control" value="SISWA">
                        </div>

                        <div class="form-group">
                            <label for="telp">Telepon</label>
                            <input type="text" name="telp" class="form-control" placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password akun" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <small class="text-muted">Sudah punya akun? <a href="{{ route('nasabah.login') }}">Login di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
