<?php
// Include koneksi database
include '../koneksi.php';

//insert
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk insert data ke tabel admin
    $sql = "INSERT INTO tb_admin (nama_admin, username, email, password) 
            VALUES (?, ?, ?, ?)";

    // Siapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama, $username, $email, $password);

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
                    text: 'Data admin berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'dataadmin.php'; // Redirect ke halaman lain
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

//delete

// Cek apakah request menggunakan AJAX untuk mengambil data
if (isset($_GET['getData']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_admin WHERE id = ?";
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
    <title>Manajemen Data Admin</title>

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
                <h1 class="text-xl font-bold text-gray-800 dark:text-white ">Manajemen Data Admin</h1>
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
                                        Data Admin
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Informasi Data Data Admin
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
                                                    <form id="form-pasien" action="dataadmin.php" method="POST">
                                                        <div class="grid gap-y-4">
                                                            <div>
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Admin</label>
                                                                    <input type="text" name="nama" id="nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <label for="username" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Username</label>
                                                                    <input type="text" name="username" id="username" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div>
                                                                    <label for="email" class="block text-sm mb-2 dark:text-white">Email</label>
                                                                    <input type="email" id="email" name="email" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="email-error">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <label for="password" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Password</label>
                                                                    <div class="relative">
                                                                        <input type="password" name="password" id="password" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                                                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 dark:text-neutral-400">
                                                                            <!-- Icon for closed eye (password hidden) -->
                                                                            <svg id="eyeIconClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                                            </svg>
                                                                            <!-- Icon for open eye (password visible) -->
                                                                            <svg id="eyeIconOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
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

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Nama Admin
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Username
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Email
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
                                $data = mysqli_query($conn, "SELECT * FROM tb_admin");
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
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"> <?php echo $row['nama_admin']; ?> </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap" style="width: 90px;">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['username']; ?></span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $row['email']; ?></span>
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
                                $query = "SELECT COUNT(*) AS total_results FROM tb_admin"; // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Edit Data Admin</h3>
            <div class="mt-5">
                <form id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="grid gap-y-4">
                        <div>
                            <div>
                                <label for="edit-nama" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Admin</label>
                                <input type="text" name="nama" id="edit-nama" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="edit-username" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Username</label>
                                <input type="text" name="username" id="edit-username" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="edit-email" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Email</label>
                                <input type="email" name="email" id="edit-email" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                            </div>
                        </div>
                        <div>
                            <label for="edit-password" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="edit-password" class="input input-bordered input-info py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                                <button type="button" id="toggleEditPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 dark:text-neutral-400">
                                    <svg id="eyeIconEditClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                    <svg id="eyeIconEditOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-action mt-4">
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white shadow-sm hover:bg-blue-700">Simpan Perubahan</button>
                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800" onclick="document.getElementById('editModal').close()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- dialog lihat data -->
    <dialog id="lihatModal" class="modal">
        <div class="modal-box ">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Close">
                    ✕
                </button>
            </form>
            <h3 class="text-lg text-center font-bold text-gray-800 dark:text-neutral-200">
                Detail Data Admin
            </h3>
            <div class="mt-4 space-y-4">
                <!-- Nama Admin -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Nama Admin:</label>
                    <p id="lihat-nama" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Username -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Username:</label>
                    <p id="lihat-username" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Email -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Email:</label>
                    <p id="lihat-email" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>

                <!-- Password -->
                <div class="flex items-center">
                    <label class="block text-sm text-gray-700 dark:text-white w-1/3">Password:</label>
                    <p id="lihat-password" class="text-gray-800 dark:text-neutral-400 w-2/3"></p>
                </div>
            </div>
        </div>
    </dialog>



</body>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const eyeIconClosed = document.getElementById('eyeIconClosed');
        const eyeIconOpen = document.getElementById('eyeIconOpen');

        if (passwordField.type === 'password') {
            passwordField.type = 'text'; // Show password
            eyeIconClosed.classList.add('hidden'); // Hide closed eye
            eyeIconOpen.classList.remove('hidden'); // Show open eye
        } else {
            passwordField.type = 'password'; // Hide password
            eyeIconClosed.classList.remove('hidden'); // Show closed eye
            eyeIconOpen.classList.add('hidden'); // Hide open eye
        }
    });


    //jsbtedit
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
                        document.getElementById('edit-nama').value = data.nama_admin;
                        document.getElementById('edit-username').value = data.username;
                        document.getElementById('edit-email').value = data.email;
                        document.getElementById('edit-password').value = data.password;

                        // Tampilkan modal menggunakan method showModal()
                        document.getElementById('editModal').showModal();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        document.getElementById('toggleEditPassword').addEventListener('click', function() {
            const passwordField = document.getElementById('edit-password');
            const eyeClosed = document.getElementById('eyeIconEditClosed');
            const eyeOpen = document.getElementById('eyeIconEditOpen');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeClosed.classList.remove('hidden');
                eyeOpen.classList.add('hidden');
            }
        });
        // Submit form dengan AJAX & SweetAlert
        document.getElementById("editForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            fetch('./manajemenadmin/edit.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Menggunakan JSON dari PHP
                .then(data => {
                    if (data.status === 'success') {
                        editModal.close(); // Tutup modal setelah submit sukses
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data admin berhasil diperbarui",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Reload halaman setelah berhasil
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Gagal memperbarui data admin",
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
                        // Isi data pada modal
                        document.getElementById('lihat-nama').textContent = data.nama_admin;
                        document.getElementById('lihat-username').textContent = data.username;
                        document.getElementById('lihat-email').textContent = data.email;
                        document.getElementById('lihat-password').textContent = data.password;

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
                        fetch("./manajemenadmin/delete.php", {
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
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
    });
</script>



</html>