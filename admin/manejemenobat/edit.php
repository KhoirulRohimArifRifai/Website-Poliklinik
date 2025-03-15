<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../../koneksi.php'; // Sesuaikan dengan lokasi koneksi database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nama_obat = $_POST['nama'];
    $jenis_obat = $_POST['jenis'];
    $dosis = $_POST['dosis'];
    $ukuran_obat = $_POST['ukuran'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_obat = '';

    // Ambil gambar lama jika ada
    $query = $conn->prepare("SELECT gambar_obat FROM obat WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $gambar_lama = $row['gambar_obat']; // Nama file lama

    // Periksa apakah ada gambar baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $gambar_obat = $_FILES['gambar']['name'];
        $targetDir = "../../imageobat";
        $targetFile = $targetDir . basename($gambar_obat);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi ekstensi file
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo json_encode(["status" => "error", "message" => "Format gambar tidak valid!"]);
            exit();
        }

        // Hapus gambar lama jika ada
        if (!empty($gambar_lama) && file_exists($targetDir . $gambar_lama)) {
            unlink($targetDir . $gambar_lama);
        }

        // Upload gambar baru
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            // Perbarui data dengan gambar baru
            $sql = "UPDATE obat SET nama_obat = ?, jenis_obat = ?, dosis = ?, ukuran_obat = ?, deskripsi = ?, gambar_obat = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nama_obat, $jenis_obat, $dosis, $ukuran_obat, $deskripsi, $gambar_obat, $id);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar!"]);
            exit();
        }
    } else {
        // Perbarui data tanpa mengubah gambar
        $sql = "UPDATE obat SET nama_obat = ?, jenis_obat = ?, dosis = ?, ukuran_obat = ?, deskripsi = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nama_obat, $jenis_obat, $dosis, $ukuran_obat, $deskripsi, $id);
    }

    header('Content-Type: application/json');

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data"]);
    }

    $stmt->close();
    $conn->close();
}
