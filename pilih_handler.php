<?php
session_start();

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cust_id = $_SESSION['user_id'];
    $penjahit_id = $_POST['penjahitid'];
    $tanggal_pengiriman = $_POST['tglpengiriman'];
    $payment_id = $_POST['paymentid'];

    if (!empty($cust_id) && !empty($penjahit_id) && !empty($payment_id) && !empty($tanggal_pengiriman)) {
        $sql = "INSERT INTO pemesanan (custid, penjahitid, tglpengiriman, paymentid) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare error: ' . $conn->error);
        }

        $stmt->bind_param('iiss', $cust_id, $penjahit_id, $tanggal_pengiriman, $payment_id);

        if ($stmt->execute()) {
            // Fetch the last inserted pemesanan_id based on known details
            $sql = "SELECT pemesananid FROM pemesanan WHERE custid = ? AND penjahitid = ? AND tglpengiriman = ? AND paymentid = ? ORDER BY pemesananid DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Prepare error: ' . $conn->error);
            }
    
            $stmt->bind_param('iiss', $cust_id, $penjahit_id, $tanggal_pengiriman, $payment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $pemesanan_id = $row['pemesananid'];
    
                // Set session variable
                $_SESSION['pemesananids'] = $pemesanan_id;
    
                // Redirect to detail_pemesanan.php
                header("location: detail_pemesanan.php");
                exit();
            } else {
                echo "Error: Could not retrieve pemesananid.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Semua field harus diisi.";
    }
}

$conn->close();
?>
