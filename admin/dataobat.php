<?php
include "../koneksi.php";

// Periksa apakah form telah disubmit


// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $namaobat = $_POST['nama'];
    $jenisobat = $_POST['jenis'];
    $dosis = $_POST['dosis'];
    $ukuranobat = $_POST['ukuran'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar
    $targetDir = "../imageobat/";
    $fileName = basename($_FILES["gambar"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validasi jenis file gambar
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file ke folder imageobat
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
            // Jika upload berhasil, simpan data ke database
            $sql = "INSERT INTO obat (nama_obat, jenis_obat, dosis, ukuran_obat, gambar_obat, deskripsi) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            // Siapkan statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $namaobat, $jenisobat, $dosis, $ukuranobat, $fileName, $deskripsi);

            // Eksekusi query
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
                            window.location = 'dataobat.php';
                        });
                    </script>
                </body>
                </html>";
            } else {
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
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan: " . addslashes($conn->error) . "',
                            confirmButtonText: 'Coba Lagi'
                        }).then(() => {
                            window.history.back();
                        });
                    </script>
                </body>
                </html>";
            }

            $stmt->close();
        } else {
            echo "
            <script>
                alert('Gagal mengupload gambar.');
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
$sql = "SELECT * FROM poli"; // Ganti 'poli' dengan nama tabel Anda
$result = $conn->query($sql);

$dialogread = "SELECT * FROM dokter";
$read = $conn->query($dialogread);

// Cek apakah request menggunakan AJAX untuk mengambil data
if (isset($_GET['getData']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM obat WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
    exit();
}


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






    <!-- Title -->
    <title>Manajemen Data Obat</title>

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
                <h1 class="text-xl font-bold text-gray-800 dark:text-white ">Manajemen Data Obat</h1>
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
                                        Data Obat
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Informasi Data Data Obat
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
                                                    <form id="form-pasien" action="dataobat.php" method="POST" enctype="multipart/form-data">
                                                        <div class="grid gap-y-4">
                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Obat</label>
                                                                    <input type="text" name="nama" id="nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="jenis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Obat</label>
                                                                    <select name="jenis" id="jenis" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <option value="" disabled selected>Pilih Jenis Obat</option>
                                                                        <option value="Tablet">Tablet</option>
                                                                        <option value="Cair">Cair</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="dosis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Dosis Obat</label>
                                                                    <input type="text" name="dosis" id="dosis" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="ukuran" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Ukuran Obat</label>
                                                                    <input type="text" name="ukuran" id="ukuran" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div>
                                                                    <label for="gambar" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Gambar Obat</label>
                                                                    <div class="relative">
                                                                        <input type="file" name="gambar" id="gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                                                                        <div class="input input-bordered input-info py-3 px-4 w-full border border-gray-200 rounded-lg text-sm text-neutral-400 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
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
                                                            </div>

                                                            <div>
                                                                <label for="hs-feedback-post-comment-textarea-1" class="block mb-2 text-sm font-medium dark:text-white">Deskripsi Obat</label>
                                                                <div class="mt-1">
                                                                    <textarea
                                                                        id="deskripsi"
                                                                        name="deskripsi"
                                                                        rows="3"
                                                                        class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                                                                </div>

                                                            </div>
                                                            <button type="submit" id="buttondaftar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Tambah Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
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
                                                    Nama Obat
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Jenis Obat
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Dosis
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Ukuran Obat
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
                                $data = mysqli_query($conn, "SELECT * FROM obat");
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <tr>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $no++ ?> </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 170px;">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $row['nama_obat']; ?> </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['jenis_obat']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 100px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['dosis']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['ukuran_obat']; ?></span>
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

                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-error delete-btn" data-id="<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                                                    </button>
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
                                $query = "SELECT COUNT(*) AS total_results FROM obat"; // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                            Next
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div>
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
        <div class="modal-box ">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Close">
                    ✕
                </button>
            </form>
            <h3 class="text-lg text-center font-bold text-gray-800 dark:text-neutral-200">
                Edit Data Admin
            </h3>
            <form id="editForm" action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit-id">
                <div class="grid gap-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                        <div>
                            <label for="edit-nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Obat</label>
                            <input type="text" name="nama" id="edit-nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400" required>
                        </div>

                        <div>
                            <label for="edit-jenis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Obat</label>
                            <select name="jenis" id="edit-jenis" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:focus:ring-neutral-600" required>
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Cair">Cair</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                        <div>
                            <label for="edit-dosis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Dosis</label>
                            <input type="text" name="dosis" id="edit-dosis" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400" required>
                        </div>

                        <div>
                            <label for="edit-ukuran" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Ukuran Obat</label>
                            <input type="text" name="ukuran" id="edit-ukuran" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400" required>
                        </div>
                    </div>
                    <div>
                        <label for="edit-gambar" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">
                            Gambar Obat
                        </label>
                        <div class="relative">
                            <input type="file" name="gambar" id="edit-gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="input input-bordered input-info py-3 px-4 w-full border border-gray-200 rounded-lg text-sm text-neutral-400 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                                <span id="edit-file-name">Memuat...</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="edit-deskripsi" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Deskripsi</label>
                        <div class="mt-1">
                            <textarea
                                name="deskripsi"
                                id="edit-deskripsi"
                                rows="4"
                                class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400"
                                required>
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-action mt-4">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white shadow-sm hover:bg-blue-700">Simpan Perubahan</button>
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800" onclick="document.getElementById('editModal').close()">Batal</button>
                </div>
            </form>

        </div>
    </dialog>

    <!-- dialog lihat data -->
    <dialog id="lihatModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Close">
                    ✕
                </button>
            </form>
            <h3 class="text-lg text-center font-bold text-gray-800 dark:text-neutral-200">
                Detail Data Obat
            </h3>
            <div class="mt-4 space-y-4">
                <!-- Nama Obat -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Nama Obat:</label>
                    <p id="lihat-nama" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Jenis Obat -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jenis Obat:</label>
                    <p id="lihat-jenis" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Dosis -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Dosis:</label>
                    <p id="lihat-dosis" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Ukuran Obat -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Ukuran Obat:</label>
                    <p id="lihat-ukuran" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Gambar Obat -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Gambar Obat:</label>
                    <img id="lihat-gambar" class="w-20 h-20 object-cover rounded-md border border-gray-300 dark:border-neutral-700" alt="Gambar Obat">
                </div>

                <!-- Deskripsi -->
                <div class="flex items-start">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Deskripsi:</label>
                    <p id="lihat-deskripsi" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
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

    //jsbtedit
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("[id^='btedit-']").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.id.split('-')[1]; // Ambil ID dari tombol

                // Fetch data dengan AJAX
                fetch(`?getData=true&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Isi data pada form modal
                        document.getElementById('edit-id').value = data.id;
                        document.getElementById('edit-nama').value = data.nama_obat;
                        document.getElementById('edit-jenis').value = data.jenis_obat;
                        document.getElementById('edit-dosis').value = data.dosis;
                        document.getElementById('edit-ukuran').value = data.ukuran_obat;
                        document.getElementById('edit-deskripsi').value = data.deskripsi;

                        // Menampilkan nama file gambar dari database
                        const fileName = document.getElementById('edit-file-name');
                        fileName.textContent = data.gambar_obat ? data.gambar_obat : "Pilih Gambar...";

                        // Tampilkan modal menggunakan showModal()
                        document.getElementById('editModal').showModal();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Event listener untuk mengganti teks saat file dipilih
        document.getElementById('edit-gambar').addEventListener('change', function() {
            const fileName = document.getElementById('edit-file-name');
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = "Pilih Gambar...";
            }
        });

        // Handle submit form dengan AJAX dan SweetAlert
        document.getElementById("editForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            fetch('./manejemenobat/edit.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('editModal').close(); // Tutup modal setelah submit sukses
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data obat berhasil diperbarui",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Refresh halaman setelah notifikasi ditutup
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Gagal memperbarui data obat",
                            icon: "error"
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
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
                        console.log(data); // Cek data yang dikirim dari backend

                        // Pastikan properti gambar ada
                        if (!data.gambar_obat) {
                            console.error("Gambar tidak tersedia dalam data");
                        }
                        // Isi data pada modal
                        document.getElementById('lihat-nama').textContent = data.nama_obat;
                        document.getElementById('lihat-jenis').textContent = data.jenis_obat;
                        document.getElementById('lihat-dosis').textContent = data.dosis;
                        document.getElementById('lihat-ukuran').textContent = data.ukuran_obat;
                        document.getElementById('lihat-deskripsi').textContent = data.deskripsi;

                        // Menampilkan gambar jika ada
                        const gambarElement = document.getElementById('lihat-gambar');
                        if (data.gambar_obat) {
                            gambarElement.src = `../imageobat/${data.gambar_obat}`;
                            gambarElement.classList.remove('hidden');
                        } else {
                            gambarElement.classList.add('hidden');
                        }


                        // Tampilkan modal menggunakan method showModal()
                        document.getElementById('lihatModal').showModal();
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

    //hapus
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                console.log("ID yang dikirim:", id); // Debugging

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("./manejemenobat/delete.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: "id=" + encodeURIComponent(id) // Pastikan ID ter-encode
                            })
                            .then(response => response.text())
                            .then(data => {
                                console.log("Response dari server:", data); // Debugging
                                if (data.trim() === "success") {
                                    Swal.fire({
                                        title: "Terhapus!",
                                        text: "Data berhasil dihapus.",
                                        icon: "success"
                                    }).then(() => {
                                        location.reload(); // Refresh halaman setelah penghapusan
                                    });
                                } else {
                                    Swal.fire("Error", "Terjadi kesalahan saat menghapus!", "error");
                                }
                            })
                            .catch(error => {
                                console.error("Fetch error:", error); // Debugging
                                Swal.fire("Error", "Terjadi kesalahan!", "error");
                            });
                    }
                });
            });
        });
    });

    // document.getElementById("buttondaftar").addEventListener("click", function(event) {
    //     // Mencegah form submit default jika diperlukan
    //     event.preventDefault();

    //     // Array field wajib diisi
    //     const requiredFields = ["nama", "jeniskelamin", "umur", "nomor", "tanggal", "poli"];
    //     const emptyFields = [];

    //     requiredFields.forEach(fieldId => {
    //         const field = document.getElementById(fieldId);
    //         if (field && !field.value.trim()) {
    //             emptyFields.push(fieldId);
    //         }
    //     });

    //     // Jika ada lebih dari satu field kosong
    //     if (emptyFields.length > 0) {
    //         // Tampilkan SweetAlert jika ada field yang kosong
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Oops...',
    //             text: 'Lengkapi semua formulir.',
    //         });
    //     }else {
    //         // Jika tidak ada field kosong
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Berhasil!',
    //             text: 'Semua formulir sudah lengkap.',
    //         });
    //         // Lanjutkan ke proses form submission
    //         // document.getElementById('form-id').submit(); // Uncomment jika menggunakan form HTML
    //     }
    // });
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
</script>



</html>