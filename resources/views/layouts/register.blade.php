<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registrasi Dibatasi - Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Fonts & Icon Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap & Custom Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f5f5f5;">

        <div class="bg-white shadow-lg rounded p-5 text-center" style="max-width: 500px;">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-4"></i>
            <h2 class="text-danger mb-3">Registrasi Tidak Tersedia</h2>
            <p class="mb-4" style="font-size: 16px;">
                Maaf, pendaftaran akun tidak tersedia di halaman ini.<br>
                Hanya <strong>admin</strong> yang berhak membuat akun baru.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Login
            </a>
        </div>

    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
