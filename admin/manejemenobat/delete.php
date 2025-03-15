<?php
include '../../koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Query hapus data
    $sql = "DELETE FROM obat WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "No ID received";
}
?>
