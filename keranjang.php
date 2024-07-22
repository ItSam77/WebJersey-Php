<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['pemesananid'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$pemesananid = $_SESSION['pemesananids'];
$custid = $_SESSION['user_id'];

// Mendapatkan informasi pemesan dan penjahit
$sql = "SELECT p.custid, p.penjahitid, p.tglpengiriman, p.paymentid, c.username, pen.namapenjahit, pay.nama_payment
        FROM pemesanan p
        JOIN customer c ON p.custid = c.custid
        JOIN penjahit pen ON p.penjahitid = pen.penjahitid
        JOIN payment pay ON p.paymentid = pay.paymentid
        WHERE p.pemesananid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $pemesananid);
$stmt->execute();
$result = $stmt->get_result();
$pemesanan = $result->fetch_assoc();

$username = $pemesanan['username'];
$namapenjahit = $pemesanan['namapenjahit'];
$tglpengiriman = $pemesanan['tglpengiriman'];
$nama_payment = $pemesanan['nama_payment'];

// Mendapatkan detail pemesanan
$sql_detail = "SELECT dp.produkid, dp.kuantitas, dp.desainproduk, pr.nama_produk, pr.harga
               FROM detailpemesanan dp
               JOIN produk pr ON dp.produkid = pr.produkid
               WHERE dp.pemesananid = ?";
$stmt_detail = $conn->prepare($sql_detail);
$stmt_detail->bind_param('i', $pemesananid);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();

$subtotal = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Pemesanan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container mt-5">
        <h2 class="text-center">Keranjang Pemesanan</h2>
        <div class="mt-4">
            <h4>Informasi Pemesanan</h4>
            <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($username); ?></p>
            <p><strong>Nama Penjahit:</strong> <?= htmlspecialchars($namapenjahit); ?></p>

            <h4>Detail Barang</h4>
            <?php while ($row = $result_detail->fetch_assoc()): 
                $total_harga = $row['kuantitas'] * $row['harga'];
                $subtotal += $total_harga;
            ?>
                <div class="border p-3 mb-3">
                    <p><strong>Jasa yang Dibuat:</strong> <?= htmlspecialchars($row['nama_produk']); ?></p>
                    <p><strong>File Desain:</strong> <a href="<?= htmlspecialchars($row['desainproduk']); ?>" target="_blank">Lihat Desain</a></p>
                    <p><strong>Kuantitas:</strong> <?= htmlspecialchars($row['kuantitas']); ?></p>
                    <p><strong>Harga per Unit:</strong> <?= htmlspecialchars(number_format($row['harga'], 2)); ?></p>
                    <p><strong>Total Harga:</strong> <?= htmlspecialchars(number_format($total_harga, 2)); ?></p>
                </div>
            <?php endwhile; ?>

            <h4>Informasi Pengiriman</h4>
            <p><strong>Tanggal Pengiriman:</strong> <?= htmlspecialchars($tglpengiriman); ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($nama_payment); ?></p>

            <h4>Subtotal</h4>
            <p><strong>Subtotal:</strong> <?= htmlspecialchars(number_format($subtotal, 2)); ?></p>

            <div class="text-center mt-4">
                <a href="detail_pemesanan.php" class="btn btn-primary">Tambah Pesanan Lagi</a>
                <a href="checkout.php" class="btn btn-success">Lanjutkan ke Pembayaran</a>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © 2024 FCSV Custom Jersey
        </div>
    </footer>

</body>
</html>

<?php
$stmt->close();
$stmt_detail->close();
$conn->close();
?>
