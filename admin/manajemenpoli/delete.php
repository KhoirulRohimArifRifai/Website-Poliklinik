<!-- deletepoli -->

<?php
session_start();
include '../../koneksi.php';

// Cek apakah ID tersedia di POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $querydelete = "DELETE FROM poli WHERE id = '$id'";
    $resultdelete = mysqli_query($conn, $querydelete);

    if ($resultdelete) {
        $_SESSION['success'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus data: " . mysqli_error($conn);
    }
}

// Redirect kembali ke halaman daftar poli
header("Location: ../datapoli.php");
exit();
?>
