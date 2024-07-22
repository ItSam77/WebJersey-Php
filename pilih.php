<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

// Mengambil data penjahit
$penjahit_sql = "SELECT penjahitid, namapenjahit FROM penjahit";
$penjahit_result = $conn->query($penjahit_sql);

// Mengambil data metode pembayaran
$payment_sql = "SELECT paymentid, nama_payment FROM payment";
$payment_result = $conn->query($payment_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pilih Penjahit dan Pembayaran</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container mt-5">
        <h2 class="text-center">Pilih Penjahit dan Metode Pembayaran</h2>
        <form action="pilih_handler.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="penjahit">Pilih Penjahit:</label>
                <select id="penjahit" name="penjahitid" class="form-control">
                    <?php
                    if ($penjahit_result->num_rows > 0) {
                        while($row = $penjahit_result->fetch_assoc()) {
                            echo "<option value='" . $row['penjahitid'] . "'>" . $row['namapenjahit'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada penjahit tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="payment">Pilih Metode Pembayaran:</label>
                <select id="payment" name="paymentid" class="form-control">
                    <?php
                    if ($payment_result->num_rows > 0) {
                        while($row = $payment_result->fetch_assoc()) {
                            echo "<option value='" . $row['paymentid'] . "'>" . $row['nama_payment'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada metode pembayaran tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tglpengiriman">Tanggal Pengiriman:</label>
                <input type="date" id="tglpengiriman" name="tglpengiriman" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>

    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © 2024 FCSV Custom Jersey
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
