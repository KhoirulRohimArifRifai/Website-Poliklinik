<?php
// Include koneksi database
include '../koneksi.php';

// Mulai sesi untuk menyimpan pesan
session_start();

// Menambahkan variabel untuk status
$alertMessage = '';

if (isset($_POST['buttondaftar'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $biaya = $_POST['biaya'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk menyimpan data
    $query = "INSERT INTO poli (namapoli, spesialis, biaya, status, deskripsi) 
                VALUES ('$nama', '$spesialis', '$biaya', '$status', '$deskripsi')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil
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
                    text: 'Data poli berhasil ditambahkan!',
                    showConfirmButton: true, // Menampilkan tombol OK
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'datapoli.php'; // Redirect ke halaman lain
                });
            </script>
        </body>
        </html>";
    } else {
        // Jika gagal
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
                    text: 'Terjadi kesalahan: " . addslashes(mysqli_error($conn)) . "',
                    confirmButtonText: 'Coba Lagi'
                }).then(() => {
                    window.history.back(); // Kembali ke halaman sebelumnya
                });
            </script>
        </body>
        </html>";
    }
    // Pastikan script berhenti setelah redirect
}
// Query untuk mengambil data dari tabel poli
$query = "SELECT * FROM poli";
$result = mysqli_query($conn, $query);

// Cek apakah request menggunakan AJAX untuk mengambil data
if (isset($_GET['getData']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM poli WHERE id = ?";
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


    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


    <!-- Title -->
    <title>Manajemen Data Poli</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/preline@latest/dist/preline.min.js"></script>


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
                <h1 class="text-xl font-bold text-gray-800 dark:text-white ">Manajemen Data Poli</h1>
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
                                        Data Poli
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Informasi Data Poli
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
                                                    <form id="form-pasien" action="datapoli.php" method="POST">
                                                        <div class="grid gap-y-4">
                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Poli</label>
                                                                    <input type="text" name="nama" id="nama" class="input input-bordered input-info w-full max-w-lg" required>
                                                                </div>
                                                                <div>
                                                                    <label for="spesialis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Spesialis</label>
                                                                    <input type="text" name="spesialis" id="spesialis" class="input input-bordered input-info w-full max-w-lg" required>
                                                                </div>
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                <div class="relative">
                                                                    <label for="biaya" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Biaya Layanan</label>
                                                                    <div class="flex items-center">
                                                                        <span class="absolute left-3 text-gray-500 dark:text-neutral-400">Rp</span>
                                                                        <input type="text" name="biaya" id="biaya"
                                                                            class="input input-bordered input-info w-full py-3 px-10 ml-12 rounded-lg text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label for="status" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Status</label>
                                                                    <input type="text" name="status" id="status" value="Aktif" readonly
                                                                        class="input input-bordered input-info w-full max-w-lg">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label for="deskripsi" class="block mb-2 text-sm font-medium dark:text-white">Deskripsi Poli</label>
                                                                <div class="mt-1">
                                                                    <textarea
                                                                        id="deskripsi"
                                                                        name="deskripsi"
                                                                        rows="3"
                                                                        class="textarea textarea-bordered textarea-info w-full max-w-lg text-sm rounded-lg py-3 px-4 border-gray-200 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                                    </textarea>
                                                                </div>
                                                            </div>

                                                            <button type="submit" id="buttondaftar" name="buttondaftar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50">
                                                                Tambah Data
                                                            </button>
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
                                                    Nama Poli
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
                                                    Biaya Layanan
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
                                                    Aksi
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 1;
                                $data = mysqli_query($conn, "SELECT * FROM poli");
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
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $row['namapoli']; ?> </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap" style="width: 90px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['spesialis']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">Rp.<?php echo $row['biaya']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-4 py-3">
                                                    <div class="badge gap-2 text-white 
        <?php echo ($row['status'] == 'Aktif') ? 'badge-success' : 'badge-error'; ?>">
                                                        <?php if ($row['status'] == 'Aktif') : ?>
                                                            <i class='bx bx-check text-white'></i>
                                                        <?php else : ?>
                                                            <i class='bx bxs-x-circle' style='color:#ffffff'></i>
                                                        <?php endif; ?>
                                                        <span class="text-white"><?php echo $row['status']; ?></span>
                                                    </div>
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
                                $query = "SELECT COUNT(*) AS total_results FROM poli"; // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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

    <!-- Dialog Edit Poli -->
    <dialog id="editModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Edit Data Poli</h3>
            <div class="mt-5">
                <form id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="grid gap-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="edit-nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Poli</label>
                                <input type="text" name="nama" id="edit-nama" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                            <div>
                                <label for="edit-spesialis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Spesialis</label>
                                <input type="text" name="spesialis" id="edit-spesialis" class="input input-bordered input-info py-3 px-4 block w-full" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="edit-biaya" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Biaya</label>
                                <div class="flex items-center">
                                    <span class="absolute text-gray-500 dark:text-neutral-400">Rp</span>
                                    <input type="text" name="biaya" id="edit-biaya"
                                        class="input input-bordered input-info w-full py-3 px-8 ml-12 rounded-lg text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        required>
                                </div>
                            </div>
                            <div>
                                <label for="edit-status" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Status</label>
                                <select name="status" id="edit-status" class="input input-bordered input-info py-3 px-4 block w-full" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="edit-deskripsi" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Deskripsi</label>
                            <div class="mt-1">
                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    rows="3"
                                    class="textarea textarea-bordered textarea-info w-full text-sm rounded-lg py-3 px-4"
                                    required>
                                </textarea>
                            </div>
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

    <!-- Dialog Lihat Data Poli -->
    <dialog id="lihatModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold text-center">Detail Data Poli</h3>
            <div class="mt-4 space-y-4">
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Nama Poli:</label>
                    <p id="lihat-nama" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Spesialis:</label>
                    <p id="lihat-spesialis" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Biaya:</label>
                    <p id="lihat-biaya" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Status:</label>
                    <p id="lihat-status" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Deskripsi:</label>
                    <p id="lihat-deskripsi" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
            </div>
        </div>
    </dialog>

</body>

<script>
    //edit
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
                        document.getElementById('edit-nama').value = data.namapoli;
                        document.getElementById('edit-spesialis').value = data.spesialis;
                        document.getElementById('edit-biaya').value = data.biaya;
                        document.getElementById('edit-status').value = data.status;
                        document.getElementById('edit-deskripsi').value = data.deskripsi;

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

            fetch('./manajemenpoli/edit.php', {
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
                            text: "Data poli berhasil diperbarui",
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
                        document.getElementById('lihat-nama').textContent = data.namapoli;
                        document.getElementById('lihat-spesialis').textContent = data.spesialis;
                        document.getElementById('lihat-biaya').textContent = data.biaya;
                        document.getElementById('lihat-status').textContent = data.status;
                        document.getElementById('lihat-deskripsi').textContent = data.deskripsi;

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


    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus data ini?");
    }
    document.getElementById('nama').addEventListener('input', function(event) {
        // Memastikan hanya huruf dan spasi yang diterima
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
    });
    document.getElementById('biaya').addEventListener('input', function(event) {
        // Membatasi hanya angka dan maksimal 2 digit
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    //hapus
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");

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
                        fetch("./manajemenpoli/delete.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: "id=" + id
                            })
                            .then(response => response.text())
                            .then(data => {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Data berhasil dihapus.",
                                    icon: "success"
                                }).then(() => {
                                    location.reload(); // Refresh halaman setelah penghapusan
                                });
                            })
                            .catch(error => {
                                Swal.fire("Error", "Terjadi kesalahan!", "error");
                            });
                    }
                });
            });
        });
    });
    //delete
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (isset($_SESSION['success'])) : ?>
            Swal.fire({
                icon: "success",
                title: "Deleted!",
                text: "<?php echo $_SESSION['success']; ?>",
                showConfirmButton: true, // Menampilkan tombol OK
                confirmButtonText: "OK"
            });
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])) : ?>
            Swal.fire({
                icon: "error",
                title: "Failed!",
                text: "<?php echo $_SESSION['error']; ?>",
                showConfirmButton: true, // Menampilkan tombol OK
                confirmButtonText: "OK"
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });

    <?php
    // Cek apakah ada session alert yang diset
    if (isset($_SESSION['alert'])):
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']); // Hapus session setelah digunakan
    ?>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertMessage; ?>',
            showConfirmButton: true,
        });
    <?php endif; ?>
</script>



</html>