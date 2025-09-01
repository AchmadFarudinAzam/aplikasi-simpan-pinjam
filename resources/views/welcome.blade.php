<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sistem Koperasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        /* Reset dasar */
        body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Background gradient */
        body {
            background: linear-gradient(135deg, #1cc7a5, #007bff);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            flex-direction: column;
            padding: 20px;
        }

        /* Logo */
        .logo-ksp {
            width: 80px;
            height: auto;
            cursor: pointer;
            transition: transform 0.2s;
            margin-bottom: 20px;
        }

        .logo-ksp:hover {
            transform: scale(1.05);
        }

        /* Judul */
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            line-height: 1.3;
        }

        /* Tombol login */
        .btn-login {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-admin {
            background-color: #1c1c1c;
        }

        .btn-nasabah {
            background-color: #00cc99;
        }

        .btn-admin:hover {
            background-color: #333;
        }

        .btn-nasabah:hover {
            background-color: #009977;
        }

        /* Link daftar */
        .text-register {
            margin-top: 20px;
            font-size: 0.95rem;
        }

        .btn-daftar {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            background-color: #00cc99;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-daftar:hover {
            background-color: #009977;
        }

        /* Responsif */
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }

            .btn-login,
            .btn-daftar {
                width: 100%;
                margin: 8px 0;
            }
        }

    </style>
</head>

<body>
    <div class="centered">
        <img src="{{ asset('images/logo-ksp.png') }}" class="logo-ksp" alt="Logo KSP">
        <h1>Selamat Datang di <br>Sistem Koperasi</h1>

        <div>
            <a href="{{ route('admin.login') }}" class="btn btn-dark btn-custom">Login Admin</a>
            <a href="{{ route('nasabah.login') }}" class="btn btn-success btn-custom">Login Nasabah</a>
        </div>

        <p class="mt-3">Belum Punya Akun?</p>
        <a href="{{ route('registrasi.index') }}" class="btn btn-success btn-custom">Daftar Sekarang</a>
    </div>
</body>
</html>
