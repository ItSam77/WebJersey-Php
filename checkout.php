<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['pemesananid'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pemesanan Selesai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .btn-custom {
            width: 100%;
            margin-bottom: 15px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container text-center">
        <h2>Pemesanan Selesai</h2>
        <div class="alert alert-success mt-4" role="alert">
            Pemesanan Anda telah masuk ke data admin. Silahkan hubungi admin untuk melanjutkan pembayaran.
        </div>
        <div class="mt-4">
            <a href="https://wa.me/6282199871127" target="_blank" class="btn btn-success btn-custom">Hubungi Admin</a>
            <a href="checkout_handler.php?action=clear" class="btn btn-primary btn-custom">Kembali ke Beranda</a>
        </div>
    </div>

    <footer class="footer bg-light text-center text-lg-start">
        <div class="text-center p-3">
            © 2024 FCSV Custom Jersey
        </div>
    </footer>
</body>
</html>
