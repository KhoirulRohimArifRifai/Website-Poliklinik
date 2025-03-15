<?php
include '../../koneksi.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Update data langsung tanpa hash password
    $query = "UPDATE tb_admin SET nama_admin = ?, username = ?, email = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $username, $email, $password, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
