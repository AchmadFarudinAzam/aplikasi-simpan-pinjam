<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Selamat Datang - Sistem Koperasi</title>
<style>
  /* Reset basic styling */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body, html {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: #fff;
  }

  /* Wrapper for center alignment */
  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
    text-align: center;
  }

  /* Logo styling */
  .logo {
    background-color: #fff;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    font-weight: bold;
    color: #1e3c72;
    font-size: 2rem;
    font-family: 'Poppins', sans-serif;
    letter-spacing: 2px;
  }

  /* Main heading */
  h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 20px;
  }

  /* Links area styling */
  .links {
    margin: 20px 0;
  }

  .links a {
    color: #a8d0ff;
    text-decoration: none;
    margin: 0 10px;
    font-weight: 600;
    transition: color 0.3s ease;
  }

  .links a:hover {
    color: #ffffff;
    text-decoration: underline;
  }

  /* Sub text */
  .subtext {
    font-size: 0.9rem;
    color: #cbd5e1;
    margin-bottom: 10px;
  }

  /* Button with modern style */
  .btn-register {
    color: #fff;
    background-color: #4fd1c5;
    padding: 10px 20px;
    border-radius: 30px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(79,209,197,0.5);
    transition: background-color 0.3s ease;
  }

  .btn-register:hover {
    background-color: #38b2ac;
  }

  /* Responsive adjustments */
  @media (max-width: 480px) {
    h1 {
      font-size: 1.6rem;
    }
    .logo {
      font-size: 1.5rem;
      padding: 10px 15px;
    }
  }
</style>
</head>
<body>

<div class="container">
  <div class="logo">KSP</div>
  <h1>Selamat Datang di<br />Sistem Koperasi</h1>

  <div class="links">
    <a href="{{ route('admin.login') }}">Login Admin</a> |
    <a href="{{ route('nasabah.login') }}">Login Nasabah</a>
  </div>

  <div class="subtext">Belum Punya Akun?</div>
  <a class="btn-register" href="{{ route('registrasi.index') }}">Daftar Sekarang</a>
</div>

</body>
</html>
