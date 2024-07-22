<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .logo {
            width: 50px;
            height: auto;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .card-custom {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="fcsv.jpg" alt="Logo" class="logo">
                <b>FCSV Custom Jersey</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Hello, <?= $_SESSION['username'] ?></span>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-secondary nav-link">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row card-custom">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Profile FCSV</h2>
                    </div>
                    <div class="card-body">
                        <p>
                        FCSV Official adalah usaha konveksi yang bergerak di bidang pembuatan baju jersey. Usaha ini didirikan dengan tujuan untuk memenuhi kebutuhan masyarakat akan baju jersey berkualitas tinggi dengan harga yang terjangkau. Usaha ini juga melayani pembuatan jersey custom dengan desain sesuai keinginan pelanggan, menyediakan berbagai pilihan bahan, dan menawarkan layanan konsultasi desain untuk memastikan kepuasan pelanggan. FCSV Official berharap dapat menjadi pilihan utama bagi masyarakat dalam memenuhi kebutuhan mereka akan baju jersey yang berkualitas.
</p>
                        <div class="text-center">
                            <p>Untuk melakukan pesanan, klik tombol dibawah!</p>
                            <a href="pilih.php" class="btn btn-danger">Order Disini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © 2024 FCSV Custom Jersey
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
