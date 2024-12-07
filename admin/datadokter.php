<?php
include "../koneksi.php";

// Periksa apakah form telah disubmit
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


    // Query untuk insert data ke tabel dokter
    $sql = "INSERT INTO dokter (namadokter, jeniskelamin, usia, spesialis, status, jadwalhari, jadwaljammulai, jadwaljamselesai) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssss", $namadokter, $jeniskelamin, $usia, $spesialis, $status, $jadwalhari, $jadwaljammulai, $jadwaljamselesai);

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
                    text: 'Data dokter berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'datadokter.php';
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
}
$sql = "SELECT * FROM poli"; // Ganti 'poli' dengan nama tabel Anda
$result = $conn->query($sql);



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
                                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-cookies" data-hs-overlay="#hs-cookies">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                                Tambah Data
                                            </button>
                                        </div>

                                        <div id="hs-cookies" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1" aria-labelledby="hs-cookies-label">
                                            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                                <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-neutral-900">
                                                    <div class="absolute top-2 end-2">
                                                        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-cookies">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M18 6 6 18" />
                                                                <path d="m6 6 12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="p-4 sm:p-7">
                                                        <div class="text-center">
                                                            <h3 id="hs-modal-signin-label" class="block text-2xl font-bold text-gray-800 dark:text-neutral-200">Tambah Data Dokter</h3>
                                                        </div>

                                                        <div class="mt-5">
                                                            <!-- Form -->
                                                            <form id="form-pasien" action="datadokter.php" method="POST">
                                                                <div class="grid gap-y-4">
                                                                    <div>
                                                                        <div>
                                                                            <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Dokter</label>
                                                                            <input type="text" name="nama" id="nama" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                        <div>
                                                                            <label for="jeniskelamin" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                                                                            <select name="jeniskelamin" id="jeniskelamin" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                                <option value="laki">Laki-laki</option>
                                                                                <option value="perempuan">Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div>
                                                                            <label for="usia" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Usia</label>
                                                                            <input type="text" name="usia" id="usia" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                        <div>
                                                                            <label for="spesialis" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Spesialis</label>
                                                                            <select name="spesialis" id="spesialis" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                                <option value="" disabled selected>Pilih Spesialis</option>
                                                                                <?php
                                                                                // Periksa apakah ada data
                                                                                if ($result->num_rows > 0) {
                                                                                    // Loop untuk menampilkan setiap data poli
                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                        echo "<option value='" . $row["namapoli"] . "'>" . $row["spesialis"] . "</option>";
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
                                                                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                                        </div>
                                                                    </div>

                                                                    <div>
                                                                        <div>
                                                                            <label for="tgljadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Hari Jadwal Dokter</label>
                                                                            <input type="text" name="tgljadwal" id="tgljadwal" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required onclick="openModal()">
                                                                        </div>

                                                                        <!-- Modal pilih hari -->
                                                                        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
                                                                            <div class="bg-white dark:bg-neutral-800 rounded-lg p-6 w-96">
                                                                                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-white">Pilih Hari</h3>
                                                                                <form id="modalForm">
                                                                                    <div class="flex flex-col space-y-2">
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Senin" class="mr-2"> Senin
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Selasa" class="mr-2"> Selasa
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Rabu" class="mr-2"> Rabu
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Kamis" class="mr-2"> Kamis
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Jumat" class="mr-2"> Jumat
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Sabtu" class="mr-2"> Sabtu
                                                                                        </label>
                                                                                        <label class="flex items-center">
                                                                                            <input type="checkbox" name="day" value="Minggu" class="mr-2"> Minggu
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="mt-4 flex justify-end">
                                                                                        <button type="button" onclick="saveDays()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">OK</button>
                                                                                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg ml-2">Tutup</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                                                        <div>
                                                                            <label for="jamjadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Mulai</label>
                                                                            <input type="time" name="jammulai" id="jammulai" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        </div>
                                                                        <div>
                                                                            <label for="jamjadwal" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jam Dokter - Selesai</label>
                                                                            <input type="time" name="jamselesai" id="jamselesai" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" id="buttondaftar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Tambah Data</button>
                                                                </div>
                                                            </form>
                                                            <!-- End Form -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['status']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap" style="width: 60px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <?php
                                                        // Format tanggal menjadi dd/mm/yyyy
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
                                                    <button class="btn btn-success" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-notifications" data-hs-overlay="#hs-notifications">
                                                        <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                                    </button>
                                                    <div id="hs-notifications" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1" aria-labelledby="hs-notifications-label">
                                                        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                                            <div class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
                                                                <div class="absolute top-2 end-2">
                                                                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-notifications">
                                                                        <span class="sr-only">Close</span>
                                                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M18 6 6 18" />
                                                                            <path d="m6 6 12 12" />
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <div class="p-4 sm:p-10 overflow-y-auto">
                                                                    <div class="mb-6 text-center">
                                                                        <h3 id="hs-notifications-label" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                                                                            Data Dokter
                                                                        </h3>
                                                                        <p class="text-gray-500 dark:text-neutral-500">
                                                                            Informasi Lengkap Data Dokter
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-gray-50 border-t dark:bg-neutral-950 dark:border-neutral-800">
                                                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" data-hs-overlay="#hs-notifications">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-warning"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></button>
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

    <!-- modal read -->
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