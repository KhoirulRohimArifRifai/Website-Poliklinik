<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $umur = $_POST['usia'];
    $nomorhp = $_POST['nomorhp'];
    $tgldaftar = $_POST['tanggal'];
    $poli = $_POST['poli'];
    $alamat = $_POST['alamat'];
    $keluhan = $_POST['keluhan'];

    // Query untuk insert data ke tabel pendaftaranpasien
    $sql = "INSERT INTO pasien (nama, jeniskelamin, umur, nomorhp, tgldaftar, poli, alamat, keluhan) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssss", $nama, $jeniskelamin, $umur, $nomorhp, $tgldaftar, $poli, $alamat, $keluhan);

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
                    text: 'Pendaftaran pasien berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'datapasien.php'; // Redirect ke halaman lain
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
                    window.history.back(); // Kembali ke halaman sebelumnya
                });
            </script>
        </body>
        </html>";
    }
}

$sql = "SELECT * FROM poli"; // Ganti 'poli' dengan nama tabel Anda
$result = $conn->query($sql);

// Cek apakah request menggunakan AJAX untuk mengambil data
if (isset($_GET['getData']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pasien WHERE id = ?";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    <!-- Title -->
    <title>Manajemen Data Pasien</title>

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
                <h1 class="text-xl font-bold text-gray-800 dark:text-white ">Manajemen Data Pasien</h1>
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
                                        Data Pasien
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Informasi Data Data Pasien
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
                                                    <form id="form-pasien" action="datapasien.php" method="POST">
                                                        <div class="grid gap-y-4">
                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Pasien</label>
                                                                    <input type="text" name="nama" id="nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="jeniskelamin" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                                                                    <select name="jeniskelamin" id="jeniskelamin" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                        <option value="Pria">Pria</option>
                                                                        <option value="Wanita">Wanita</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="usia" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Usia</label>
                                                                    <input type="text" name="usia" id="usia" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="nomorhp" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">No.HP</label>
                                                                    <input type="text" name="nomorhp" id="nomorhp" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="nomorhp" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Tanggal Pelayanan</label>
                                                                    <input type="date" name="tanggal" id="tanggal" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                                <div>
                                                                    <label for="poli" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Pilih Poli</label>
                                                                    <select name="poli" id="poli" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <option value="" disabled selected>Pilih Poli</option>
                                                                        <?php
                                                                        // Periksa apakah ada data
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                if ($row["status"] === "Aktif") { // Pastikan kolom status bernama "status"
                                                                                    echo "<option value='" . $row["namapoli"] . "'>" . $row["namapoli"] . "</option>";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            echo "<option disabled>Tidak ada data</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label for="hs-feedback-post-comment-textarea-1" class="block mb-2 text-sm font-medium dark:text-white">Alamat</label>
                                                                <div class="mt-1">
                                                                    <textarea
                                                                        id="alamat"
                                                                        name="alamat"
                                                                        rows="2"
                                                                        class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label for="hs-feedback-post-comment-textarea-1" class="block mb-2 text-sm font-medium dark:text-white">Keluhan Pasien</label>
                                                                <div class="mt-1">
                                                                    <textarea
                                                                        id="keluhan"
                                                                        name="keluhan"
                                                                        rows="2"
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
                                                    Nama
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Jenis Kelamin
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Umur
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Tanggal Pelayanan
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Poli
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
                                $data = mysqli_query($conn, "SELECT * FROM pasien");
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <tr>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $no++ ?> </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $row['nama']; ?> </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['jeniskelamin']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['umur']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <?php echo date('d-m-Y', strtotime($row['tgldaftar'])); ?>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['poli']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="flex items-center px-6 py-1.5 space-x-2">
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
                                $query = "SELECT COUNT(*) AS total_results FROM pasien"; // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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
    <!-- Dialog Edit Pasien -->
    <dialog id="editModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Edit Data Pasien</h3>
            <div class="mt-5">
                <form id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="grid gap-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="edit-nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Pasien</label>
                                <input type="text" name="nama" id="edit-nama" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                            <div>
                                <label for="edit-jeniskelamin" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                                <select name="jeniskelamin" id="edit-jeniskelamin" class="input input-bordered input-info py-3 px-4 block w-full" required>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="edit-usia" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Usia</label>
                                <input type="text" name="usia" id="edit-usia" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                            <div>
                                <label for="edit-nomorhp" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">No. HP</label>
                                <input type="text" name="nomorhp" id="edit-nomorhp" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="edit-tanggal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Tanggal Pelayanan</label>
                                <input type="date" name="tanggal" id="edit-tanggal" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                            <div>
                                <label for="edit-poli" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Pilih Poli</label>
                                <select name="poli" id="edit-poli" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <option value="" disabled selected>Pilih Poli</option>
                                    <?php
                                    // Query untuk mengambil data dari tabel poli
                                    $query = "SELECT * FROM poli";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        die("Query gagal: " . $conn->error);
                                    }
                                    // Periksa apakah ada data
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row["status"] === "Aktif") { // Pastikan kolom status bernama "status"
                                                echo "<option value='" . $row["namapoli"] . "'>" . $row["namapoli"] . "</option>";
                                            }
                                        }
                                    } else {
                                        echo "<option disabled>Tidak ada data</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="edit-alamat" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Alamat</label>
                            <textarea name="alamat" id="edit-alamat" rows="2" class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg" required></textarea>
                        </div>
                        <div>
                            <label for="edit-keluhan" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Keluhan Pasien</label>
                            <textarea name="keluhan" id="edit-keluhan" rows="2" class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg" required></textarea>
                        </div>
                    </div>
                    <div class="modal-action mt-4">
                        <button type="submit" class="py-2 px-3 bg-blue-600 text-white rounded-lg">Simpan Perubahan</button>
                        <button type="button" class="py-2 px-3 bg-gray-200 rounded-lg" onclick="document.getElementById('editModal').close()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Dialog Lihat Pasien -->
    <dialog id="lihatModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold text-center">Detail Data Pasien</h3>
            <div class="mt-4 space-y-4">
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Nama Pasien:</label>
                    <p id="view-nama" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Jenis Kelamin:</label>
                    <p id="view-jeniskelamin" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Usia:</label>
                    <p id="view-usia" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">No. HP:</label>
                    <p id="view-nomorhp" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Tanggal Daftar Pelayanan:</label>
                    <p id="view-tgl" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Poli:</label>
                    <p id="view-poli" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Alamat:</label>
                    <p id="view-alamat" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Keluhan:</label>
                    <p id="view-keluhan" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
            </div>
        </div>
    </dialog>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event Listener untuk tombol edit
        document.querySelectorAll('button[id^="btedit-"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.split('-')[1]; // Ambil ID dari tombol

                // Fetch data dengan AJAX
                fetch(`?getData=true&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi data pada form modal
                        document.getElementById('edit-id').value = data.id;
                        document.getElementById('edit-nama').value = data.nama;
                        document.getElementById('edit-jeniskelamin').value = data.jeniskelamin;
                        document.getElementById('edit-usia').value = data.umur;
                        document.getElementById('edit-nomorhp').value = data.nomorhp;
                        document.getElementById('edit-tanggal').value = data.tgldaftar;
                        document.getElementById('edit-poli').value = data.poli;
                        document.getElementById('edit-alamat').value = data.alamat;
                        document.getElementById('edit-keluhan').value = data.keluhan;

                        // Tampilkan modal menggunakan method showModal()
                        document.getElementById('editModal').showModal();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Submit form dengan AJAX & SweetAlert
        document.getElementById("editForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            fetch('./manajemenpasien/edit.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text()) // Debugging dulu, pakai .text()
                .then(data => {
                    console.log("Response dari server:", data); // Lihat isi respons
                    return JSON.parse(data); // Parsing manual
                })
                .then(data => {
                    if (data.status === 'success') {
                        editModal.close();
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data pasien berhasil diperbarui",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire("Gagal!", data.message, "error");
                    }
                })
                .catch(error => console.error("Error Fetch:", error));
        });

        // Event Listener untuk tombol lihat
        document.querySelectorAll('button[id^="btlihat-"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.split('-')[1]; // Ambil ID dari tombol

                // Fetch data dengan AJAX
                fetch(`?getData=true&id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi data pada modal
                        document.getElementById('view-nama').textContent = data.nama;
                        document.getElementById('view-jeniskelamin').textContent = data.jeniskelamin;
                        document.getElementById('view-usia').textContent = data.umur;
                        document.getElementById('view-nomorhp').textContent = data.nomorhp;
                        document.getElementById('view-tgl').textContent = formatTanggal(data.tgldaftar);

                        function formatTanggal(tanggal) {
                            let date = new Date(tanggal);
                            let day = String(date.getDate()).padStart(2, '0');
                            let month = String(date.getMonth() + 1).padStart(2, '0');
                            let year = date.getFullYear();
                            return `${day}/${month}/${year}`;
                        }
                        document.getElementById('view-poli').textContent = data.poli;
                        document.getElementById('view-alamat').textContent = data.alamat;
                        document.getElementById('view-keluhan').textContent = data.keluhan;

                        // Tampilkan modal menggunakan method showModal()
                        document.getElementById('lihatModal').showModal();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Event Listener untuk tombol close pada modal
        document.querySelectorAll('button[aria-label="Close"]').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('viewModal').close();
            });
        });

        // Tutup modal saat klik di luar modal-box
        document.getElementById('viewModal').addEventListener('click', function(event) {
            const modalBox = document.querySelector('#viewModal .modal-box');
            if (!modalBox.contains(event.target)) {
                this.close();
            }
        });
    });



    // Menambahkan event listener pada tombol "Lihat"
    document.querySelectorAll('.btn.btn-success').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id'); // Ambil ID dari atribut data-id
            showModal(id);
        });
    });


    document.getElementById('nama').addEventListener('input', function(event) {
        // Memastikan hanya huruf dan spasi yang diterima
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
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