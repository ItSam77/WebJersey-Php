<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['pemesananid'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

// Mengambil data produk jasa
$produk_sql = "SELECT produkid, nama_produk FROM produk";
$produk_result = $conn->query($produk_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container mt-5">
        <h2 class="text-center">Detail Pemesanan</h2>
        <form action="detail_pemesanan_handler.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="produk">Pilih Produk Jasa:</label>
                <select id="produk" name="produkid" class="form-control">
                    <?php
                    if ($produk_result->num_rows > 0) {
                        while($row = $produk_result->fetch_assoc()) {
                            echo "<option value='" . $row['produkid'] . "'>" . $row['nama_produk'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada produk jasa tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="desainproduk">Unggah File Desain:</label>
                <input type="file" id="desainproduk" name="desainproduk" class="form-control">
            </div>
            <div class="form-group">
                <label for="kuantitas">Kuantitas:</label>
                <input type="number" id="kuantitas" name="kuantitas" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" name="add_more" class="btn btn-primary mt-3">Tambah Pesanan Lagi</button>
                <button type="submit" name="checkout" class="btn btn-success mt-3">Lanjutkan ke Keranjang</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data berhasil dimasukkan ke keranjang.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © 2024 FCSV Custom Jersey
        </div>
    </footer>

    <script>
        // Script to trigger modal
        <?php if (isset($_SESSION['show_modal']) && $_SESSION['show_modal']): ?>
            $('#successModal').modal('show');
            <?php unset($_SESSION['show_modal']); ?>
        <?php endif; ?>
    </script>

</body>
</html>

<?php
$conn->close();
?>
