<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #e9ecef;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Login Admin</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="role">Login Sebagai:</label>
                            <select name="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="nasabah">Nasabah</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="usernamex">Username:</label>
                            <input type="text" name="usernamex" class="form-control" placeholder="Masukkan Username" required>
                        </div>

                        <div class="form-group">
                            <label for="passwordx">Password:</label>
                            <input type="password" name="passwordx" class="form-control" placeholder="Masukkan Password" required>
                        </div>

                        <button type="submit" class="btn btn-danger btn-block">Submit</button>
                    </form>

                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
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
