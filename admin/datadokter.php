<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $namadokter = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $usia = $_POST['usia'];
    $spesialis = $_POST['spesialis'];
    $status = $_POST['status'];
    $jadwalhari = $_POST['tgljadwal'];
    $jadwaljammulai = $_POST['jammulai'];
    $jadwaljamselesai = $_POST['jamselesai'];

    // Proses upload foto
    $targetDir = "../imagedokter/";
    $fileName = basename($_FILES["foto"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO dokter (namadokter, jeniskelamin, usia, spesialis, status, jadwalhari, jadwaljammulai, jadwaljamselesai, foto_dokter) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissssss", $namadokter, $jeniskelamin, $usia, $spesialis, $status, $jadwalhari, $jadwaljammulai, $jadwaljamselesai, $fileName);

            if ($stmt->execute()) {
                echo "
                <!DOCTYPE html>
                <html>
                <head>
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data obat berhasil ditambahkan!',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location = 'datadokter.php';
                        });
                    </script>
                </body>
                </html>";
            } else {
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan: " . addslashes($conn->error) . "',
                        confirmButtonText: 'Coba Lagi'
                    }).then(() => {
                        window.history.back();
                    });
                </script>";
            }

            $stmt->close();
        } else {
            echo "
            <script>
                alert('Gagal mengupload foto.');
                window.history.back();
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.');
            window.history.back();
        </script>";
    }
}

ob_end_flush(); // Kirim semua output yang tertahan
$sql = "SELECT * FROM poli"; // Ganti 'poli' dengan nama tabel Anda
$result = $conn->query($sql);

// $dialogread = "SELECT * FROM dokter";
// $read = $conn->query($dialogread);

// Cek apakah request menggunakan AJAX untuk mengambil data
if (isset($_GET['getData']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM dokter WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
    exit();
}


$limit = 5;

// Ambil nomor halaman dari URL (default halaman 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

// Hitung offset untuk query SQL
$offset = ($page - 1) * $limit;

// Hitung total data
$totalDataQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM dokter");
$totalData = mysqli_fetch_assoc($totalDataQuery)['total'];
$totalPages = ceil($totalData / $limit);

// Query data dengan pagination
$data = mysqli_query($conn, "SELECT * FROM dokter LIMIT $limit OFFSET $offset");
$no = $offset + 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="https://preline.co/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">

    <meta name="twitter:site" content="@preline">
    <meta name="twitter:creator" content="@preline">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tailwind CSS Admin Template | Preline UI, crafted with Tailwind CSS">
    <meta name="twitter:description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">
    <meta name="twitter:image" content="https://preline.co/assets/img/og-image.png">

    <meta property="og:url" content="https://preline.co/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Preline">
    <meta property="og:title" content="Tailwind CSS Admin Template | Preline UI, crafted with Tailwind CSS">
    <meta property="og:description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">
    <meta property="og:image" content="https://preline.co/assets/img/og-image.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">





    <!-- Title -->
    <title>Manajemen Data Dokter</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">




    <!-- Apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.css">
    <style type="text/css">
        .apexcharts-tooltip.apexcharts-theme-light {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
    </style>

    <!-- CSS Preline -->
    <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
</head>

<body>
    <?php
    include 'sidebar.php';
    ?>

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div id="dashboard" class="scroll-mt-24">
                <h1 class="text-xl font-bold text-gray-800 dark:text-white ">Manajemen Data Dokter</h1>
            </div>
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                            <!-- Header -->
                            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                        Data Dokter
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Informasi Data Data Dokter
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                            View all
                                        </button>

                                        <div class="text-center">
                                            <button type="button"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                onclick="my_modal_3.showModal()"
                                                aria-haspopup="dialog"
                                                aria-expanded="false">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                                Tambah Data
                                            </button>

                                        </div>
                                        <!-- Modal dengan DaisyUI -->
                                        <dialog id="my_modal_3" class="modal">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                </form>
                                                <h3 class="text-lg font-bold">Tambah Data Pasien</h3>
                                                <div class="mt-5">
                                                    <!-- Form -->
                                                    <form id="form-pasien" action="datadokter.php" method="POST" enctype="multipart/form-data">
                                                        <div class="grid gap-y-4">
                                                            <div>
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Dokter</label>
                                                                    <input type="text" name="nama" id="nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="jeniskelamin" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                                                                    <select name="jeniskelamin" id="jeniskelamin" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                        <option value="laki">Laki-laki</option>
                                                                        <option value="perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                    <label for="usia" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Usia</label>
                                                                    <input type="text" name="usia" id="usia" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="spesialis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Spesialis</label>
                                                                    <select name="spesialis" id="spesialis" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <option value="" disabled selected>Pilih Spesialis</option>
                                                                        <?php
                                                                        // Periksa apakah ada data
                                                                        if ($result->num_rows > 0) {
                                                                            // Loop untuk menampilkan setiap data poli dengan status "Aktif"
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                if ($row["status"] == "Aktif") { // Hanya tampilkan jika status "Aktif"
                                                                                    echo "<option value='" . $row["namapoli"] . "'>" . $row["namapoli"] . "</option>";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            echo "<option disabled>Tidak ada data</option>";
                                                                        }
                                                                        ?>
                                                                    </select>

                                                                </div>
                                                                <div>
                                                                    <label for="status" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Status</label>
                                                                    <input type="text" name="status" id="status" value="Aktif" readonly
                                                                        class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div>
                                                                    <label for="tgljadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Hari Jadwal Dokter</label>
                                                                    <input type="text" name="tgljadwal" id="tgljadwal" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required onclick="openModal()">
                                                                </div>

                                                                <!-- Modal pilih hari -->
                                                                <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
                                                                    <div class="bg-white dark:bg-neutral-800 rounded-lg p-6 w-96">
                                                                        <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-white">Pilih Hari</h3>
                                                                        <form id="modalForm" class="p-6 bg-base-100 rounded-lg shadow-lg">
                                                                            <div class="flex flex-col space-y-2">
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Senin" class="checkbox checkbox-primary mr-2"> Senin
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Selasa" class="checkbox checkbox-primary mr-2"> Selasa
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Rabu" class="checkbox checkbox-primary mr-2"> Rabu
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Kamis" class="checkbox checkbox-primary mr-2"> Kamis
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Jumat" class="checkbox checkbox-primary mr-2"> Jumat
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Sabtu" class="checkbox checkbox-primary mr-2"> Sabtu
                                                                                </label>
                                                                                <label class="flex items-center cursor-pointer">
                                                                                    <input type="checkbox" name="day" value="Minggu" class="checkbox checkbox-primary mr-2"> Minggu
                                                                                </label>
                                                                            </div>
                                                                            <div class="mt-4 flex justify-end space-x-2">
                                                                                <button type="button" onclick="saveDays()" class="btn btn-primary">OK</button>
                                                                                <button type="button" onclick="closeModal()" class="btn btn-neutral">Tutup</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="jamjadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Mulai</label>
                                                                    <input type="time" name="jammulai" id="jammulai" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="jamjadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Selesai</label>
                                                                    <input type="time" name="jamselesai" id="jamselesai" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <label for="gambar" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Gambar Obat</label>
                                                                    <div class="relative">
                                                                        <input type="file" name="foto" id="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                                                                        <div class="input input-bordered input-info py-3 px-4 w-full border border-gray-200 rounded-lg text-sm text-neutral-400 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                                                                            <span id="file-name">Pilih Gambar...</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    const fileInput = document.getElementById('foto');
                                                                    const fileName = document.getElementById('file-name');

                                                                    fileInput.addEventListener('change', function() {
                                                                        if (this.files.length > 0) {
                                                                            fileName.textContent = this.files[0].name;
                                                                        } else {
                                                                            fileName.textContent = "Pilih Gambar...";
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                            <button type="submit" id="buttondaftar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Tambah Data</button>
                                                        </div>
                                                    </form>
                                                    <!-- End Form -->
                                                </div>
                                            </div>
                                        </dialog>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="ps-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    No
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="ps-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Nama Dokter
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Spesialis
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Status
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Jadwal Hari Dokter
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Jam Dokter
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Aksi
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 1;
                                $data = mysqli_query($conn, "SELECT * FROM dokter");
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <tr>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $no++ ?> </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 180px;">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $row['namadokter']; ?> </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['spesialis']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-4 py-3">
                                                    <div class="badge badge-success gap-2 text-white">
                                                        <i class='bx bx-check text-white'></i>
                                                        <span class="text-white"><?php echo $row['status']; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 60px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <?php
                                                        echo $row['jadwalhari'];
                                                        ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 150px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <?php
                                                        // Format jam menjadi jam:menit
                                                        $jammulai = $row['jadwaljammulai'];
                                                        $formatted_jammulai = date('H:i', strtotime($jammulai)); // Asumsi format jam awal adalah HH:MM

                                                        $jamselesai = $row['jadwaljamselesai'];
                                                        $formatted_jamselesai = date('H:i', strtotime($jamselesai));

                                                        echo   $formatted_jammulai . ' - ' . $formatted_jamselesai;
                                                        ?>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5">
                                                    <!-- Tombol Lihat -->
                                                    <button class="btn btn-success" id="btlihat-<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                                    </button>

                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning" id="btedit-<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                    </button>

                                                    <button class="btn btn-error"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></button>
                                                </div>
                                            </td>

                                        <?php } ?>
                                        </tr>

                                    </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                                <?php
                                // Query untuk menghitung jumlah data di tabel
                                $query = "SELECT COUNT(*) AS total_results FROM dokter"; // Ganti 'nama_tabel' dengan nama tabel yang sesuai
                                $result = mysqli_query($conn, $query); // Ganti $koneksi dengan koneksi database Anda

                                // Ambil hasil jumlah data
                                $row = mysqli_fetch_assoc($result);
                                $total_results = $row['total_results'];
                                ?>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        <span class="font-semibold text-gray-800 dark:text-neutral-200"><?php echo $total_results; ?></span> results
                                    </p>
                                </div>

                                <!-- Navigasi Pagination -->
                                <div class="mt-4 inline-flex gap-x-2">
                                    <?php if ($page > 1) { ?>
                                        <a href="?page=<?php echo $page - 1; ?>" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </a>
                                    <?php } ?>

                                    <?php if ($page < $totalPages) { ?>
                                        <a href="?page=<?php echo $page + 1; ?>" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                            Next
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Content -->

    <!-- dialog edit data -->
    <dialog id="editModal" class="modal">
        <div class="modal-box relative bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Close">
                    ✕
                </button>
            </form>
            <h3 class="text-lg text-center font-bold text-gray-800 dark:text-neutral-200">
                Edit Data Dokter
            </h3>
            <form id="editForm" action="datadokter.php" method="POST" class="mt-4">
                <input type="hidden" name="id" id="edit-id">

                <!-- Nama Dokter -->
                <div class="mb-4">
                    <label for="edit-nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Dokter</label>
                    <input type="text" name="nama" id="edit-nama" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-4">
                    <label for="edit-jeniskelamin" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                    <select name="jeniskelamin" id="edit-jeniskelamin" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:focus:ring-neutral-600">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Usia -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                    <div class="mb-4">
                        <label for="edit-usia" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Usia</label>
                        <input type="number" name="usia" id="edit-usia" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>

                    <!-- Spesialis -->
                    <div class="mb-4">
                        <label for="edit-spesialis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Spesialis</label>
                        <select name="spesialis" id="edit-spesialis" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:focus:ring-neutral-600" required>
                            <option value="" disabled selected>Pilih Spesialis</option>
                            <?php
                            $sql = "SELECT * FROM poli";
                            $result = $conn->query($sql);

                            // Cek apakah query berhasil
                            if (!$result) {
                                die("Query Error: " . $conn->error);
                            }

                            // Debug untuk melihat data yang diambil
                            // Debug untuk melihat data
                            echo "<pre>";
                            print_r($result->fetch_assoc());
                            echo "</pre>";

                            // Kembalikan pointer ke baris pertama
                            mysqli_data_seek($result, 0);

                            // Tampilkan data dalam <option>
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row["namapoli"]) . "'>" . htmlspecialchars($row["namapoli"]) . "</option>";
                                }
                            } else {
                                echo "<option disabled>Tidak ada data</option>";
                            }

                            ?>

                        </select>
                    </div>
                </div>
                <!-- Status -->
                <div class="mb-4">
                    <label for="edit-status" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Status</label>
                    <select name="status" id="edit-status" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:focus:ring-neutral-600">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <!-- Jadwal Hari -->
                <div class="mb-4">
                    <label for="edit-jadwal-hari" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jadwal Hari</label>
                    <input type="text" name="jadwal_hari" id="edit-jadwal-hari" placeholder="Contoh: Senin - Jumat" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">

                    <!-- Modal pilih hari -->
                    <div id="modaledithari" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
                        <div class="bg-white dark:bg-neutral-800 rounded-lg p-6 w-96">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-white">Pilih Hari</h3>
                            <form id="modalForm">
                                <div class="flex flex-col space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Senin" class="mr-2"> Senin
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Selasa" class="mr-2"> Selasa
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Rabu" class="mr-2"> Rabu
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Kamis" class="mr-2"> Kamis
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Jumat" class="mr-2"> Jumat
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Sabtu" class="mr-2"> Sabtu
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="editday" value="Minggu" class="mr-2"> Minggu
                                    </label>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="button" onclick="saveeditDays()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">OK</button>
                                    <button type="button" onclick="closeModaledit()" class="px-4 py-2 bg-gray-600 text-white rounded-lg ml-2">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div>
                    <div>
                        <label for="gambar" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Gambar Obat</label>
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                            <div class="py-3 px-4 w-full border border-gray-200 rounded-lg text-sm text-neutral-400 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                                <span id="file-name">Pilih Gambar...</span>
                            </div>
                        </div>
                    </div>

                    <script>
                        const fileInput = document.getElementById('gambar');
                        const fileName = document.getElementById('file-name');

                        fileInput.addEventListener('change', function() {
                            if (this.files.length > 0) {
                                fileName.textContent = this.files[0].name;
                            } else {
                                fileName.textContent = "Pilih Gambar...";
                            }
                        });
                    </script>
                </div> -->

                <!-- Jadwal Jam -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                    <div class="mb-4">
                        <label for="edit-jadwal-jam-mulai" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Mulai</label>
                        <input type="time" name="jadwal-jam-mulai" id="edit-jadwal-jam-mulai" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-jadwal-jam-selesai" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Selesai</label>
                        <input type="time" name="jadwal-jam-selesai" id="edit-jadwal-jam-selesai" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white shadow-sm hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
                        Simpan Perubahan
                    </button>
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" onclick="document.getElementById('editModal').close()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </dialog>


    <!-- dialog lihat data -->
    <dialog id="lihatModal" class="modal">
        <div class="modal-box relative bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Close">
                    ✕
                </button>
            </form>
            <h3 class="text-lg text-center font-bold text-gray-800 dark:text-neutral-200">
                Detail Data Dokter
            </h3>
            <div class="mt-4 space-y-4">
                <!-- Nama Dokter -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Nama Dokter:</label>
                    <p id="lihat-nama" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Jenis Kelamin -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jenis Kelamin:</label>
                    <p id="lihat-jeniskelamin" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Usia -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Usia:</label>
                    <p id="lihat-usia" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Spesialis -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Spesialis:</label>
                    <p id="lihat-spesialis" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Status:</label>
                    <p id="lihat-status" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Jadwal Hari -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jadwal Hari:</label>
                    <p id="lihat-jadwal-hari" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Jadwal Jam Mulai -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jam Mulai:</label>
                    <p id="lihat-jadwal-jam-mulai" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Jadwal Jam Selesai -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jam Selesai:</label>
                    <p id="lihat-jadwal-jam-selesai" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
            </div>

        </div>
    </dialog>


</body>

<script>
    function openModal() {
        document.getElementById("modal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("modal").classList.add("hidden");
    }

    function saveDays() {
        // Mengambil semua checkbox yang dicentang
        const selectedDays = document.querySelectorAll('input[name="day"]:checked');

        // Jika ada pilihan, gabungkan nilai checkbox yang dipilih menjadi string
        if (selectedDays.length > 0) {
            const selectedValues = Array.from(selectedDays).map(checkbox => checkbox.value);
            // Masukkan hasil pilihan ke dalam input tgljadwal
            document.getElementById("tgljadwal").value = selectedValues.join(", ");
            closeModal(); // Tutup modal setelah memilih
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Harap Pilih Hari!"
            });
        }
    }


    // Menampilkan modal saat input teks diklik
    document.getElementById('edit-jadwal-hari').addEventListener('click', function() {
        document.getElementById('modaledithari').classList.remove('hidden');
    });

    // Menutup modal
    function closeModaledit() {
        document.getElementById('modaledithari').classList.add('hidden');
    }

    // Menyimpan pilihan hari ke dalam input teks
    function saveeditDays() {
        const checkedDays = Array.from(document.querySelectorAll('input[name="editday"]:checked'))
            .map(checkbox => checkbox.value);
        const jadwal = checkedDays.join(', ');
        document.getElementById('edit-jadwal-hari').value = jadwal;
        closeModaledit();
    }


    // Fungsi untuk menampilkan modal dan mengisi data
    function showModal(data) {
        // Isi data ke dalam modal
        document.getElementById('nama').value = data.nama;
        document.getElementById('jeniskelamin').value = data.jeniskelamin;
        document.getElementById('umur').value = data.umur;
        document.getElementById('tgldaftar').value = data.tgldaftar;
        document.getElementById('poli').value = data.poli;

        // Menampilkan modal
        const modal = document.getElementById('hs-notifications');
        modal.classList.remove('hidden');
    }


    //jsbtedit
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('button[id^="btedit-"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.split('-')[1];

                fetch(`?getData=true&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit-id').value = data.id;
                        document.getElementById('edit-nama').value = data.namadokter;
                        document.getElementById('edit-jeniskelamin').value = data.jeniskelamin;
                        document.getElementById('edit-usia').value = data.usia;
                        document.getElementById('edit-spesialis').value = data.spesialis;
                        document.getElementById('edit-status').value = data.status;
                        document.getElementById('edit-jadwal-hari').value = data.jadwalhari;
                        document.getElementById('edit-jadwal-jam-mulai').value = data.jadwaljammulai;
                        document.getElementById('edit-jadwal-jam-selesai').value = data.jadwaljamselesai;

                        document.getElementById('editModal').showModal();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });



    //js btlihat
    document.addEventListener('DOMContentLoaded', function() {
        // Event Listener untuk tombol lihat
        document.querySelectorAll('button[id^="btlihat-"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.split('-')[1]; // Ambil ID dari tombol

                // Fetch data dengan AJAX
                fetch(`?getData=true&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.error) {
                            // Isi data pada modal
                            document.getElementById('lihat-nama').textContent = data.namadokter;
                            document.getElementById('lihat-jeniskelamin').textContent = data.jeniskelamin;
                            document.getElementById('lihat-usia').textContent = data.usia;
                            document.getElementById('lihat-spesialis').textContent = data.spesialis;
                            document.getElementById('lihat-status').textContent = data.status;
                            document.getElementById('lihat-jadwal-hari').textContent = data.jadwalhari;
                            document.getElementById('lihat-jadwal-jam-mulai').textContent = data.jadwaljammulai;
                            document.getElementById('lihat-jadwal-jam-selesai').textContent = data.jadwaljamselesai;

                            // Tampilkan modal menggunakan method showModal()
                            document.getElementById('lihatModal').showModal();
                        } else {
                            console.error('Data tidak ditemukan:', data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Event Listener untuk tombol close pada modal
        document.querySelectorAll('button[aria-label="Close"]').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('lihatModal').close();
            });
        });

        // Tutup modal saat klik di luar modal-box
        document.getElementById('lihatModal').addEventListener('click', function(event) {
            const modalBox = document.querySelector('#lihatModal .modal-box');
            if (!modalBox.contains(event.target)) {
                this.close();
            }
        });
    });

    document.getElementById('nama').addEventListener('input', function(event) {
        // Memastikan hanya huruf dan spasi yang diterima
        this.value = this.value.replace(/[^A-Za-z\s.]/g, '');
    });
    document.getElementById('usia').addEventListener('input', function(event) {
        // Membatasi hanya angka dan maksimal 2 digit
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);
    });
    document.getElementById('nomorhp').addEventListener('input', function(event) {
        // Membatasi hanya angka dan maksimal 2 digit
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
    });

    function navigatePage(page) {
        // Reload halaman dengan parameter page
        window.location.href = '?page=' + page;
    }
</script>



</html>