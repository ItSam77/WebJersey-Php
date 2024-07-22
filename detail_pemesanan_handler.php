<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pemesanan_id = $_SESSION['pemesananids'];
    $produk_id = $_POST['produkid'];
    $kuantitas = $_POST['kuantitas'];
    $desain_file = $_FILES['desainproduk'];

    // Debugging: Print pemesananid
    error_log("Pemesanan ID: " . $pemesanan_id);

    // Pastikan semua variabel terisi
    if (!empty($pemesanan_id) && !empty($produk_id) && !empty($kuantitas) && !empty($desain_file)) {
        // Upload file desain
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($desain_file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($desain_file["tmp_name"], $target_file)) {
                $sql = "INSERT INTO detailpemesanan (pemesananid, produkid, kuantitas, desainproduk) VALUES (?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die('Prepare error: ' . $conn->error);
                }

                $stmt->bind_param('iiis', $pemesanan_id, $produk_id, $kuantitas, $target_file);

                if ($stmt->execute()) {
                    $_SESSION['show_modal'] = true; // Set session to show modal
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();

                // Menentukan aksi berdasarkan tombol yang diklik
                if (isset($_POST['add_more'])) {
                    header("Location: detail_pemesanan.php");
                } elseif (isset($_POST['checkout'])) {
                    header("Location: keranjang.php");
                }
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        header("Location: keranjang.php");
    }
}

$conn->close();
?>
