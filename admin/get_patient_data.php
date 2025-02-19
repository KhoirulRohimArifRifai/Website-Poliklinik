<?php
include "../koneksi.php"; // Sesuaikan dengan file koneksi Anda

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pasien WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // Pastikan data ditemukan
    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(null); // Jika tidak ditemukan, mengembalikan null
    }
}
?>
