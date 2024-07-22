<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses pesanan dan arahkan ke halaman pemesanan selesai
    header("Location: order_complete.php");
    exit();
} elseif (isset($_GET['action']) && $_GET['action'] == 'clear') {
    // Menghapus data sesi yang terkait dengan pemesanan
    unset($_SESSION['pemesananid']);
    unset($_SESSION['detail_pemesanan']);
    // Tambahkan variabel sesi lain yang ingin dihapus di sini
    header("Location: index.php");
    exit();
}
