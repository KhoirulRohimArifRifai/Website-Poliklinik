<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Pastikan respons dalam format JSON

$response = ['status' => 'error', 'message' => 'Terjadi kesalahan'];
try {
    // Periksa apakah request menggunakan metode POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Metode request tidak valid");
    }

    // Periksa apakah ID dikirim
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        throw new Exception("ID tidak ditemukan");
    }

    require '../../koneksi.php'; // Pastikan file ini ada dan benar

    $id = $_POST['id'];
    $nama_poli = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $biaya = $_POST['biaya'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    // Perbaiki query update (tanpa gambar)
    $sql = "UPDATE poli SET namapoli = ?, spesialis = ?, biaya = ?, status = ?, deskripsi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama_poli, $spesialis, $biaya, $status, $deskripsi, $id);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Data berhasil diperbarui'];
    } else {
        throw new Exception("Gagal memperbarui data");
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Kirim respons JSON
echo json_encode($response);
?>
