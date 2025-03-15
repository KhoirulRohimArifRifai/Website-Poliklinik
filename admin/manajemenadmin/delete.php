<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM tb_admin WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "success"; // Mengembalikan respon sukses
    } else {
        echo "error"; // Mengembalikan respon error
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
