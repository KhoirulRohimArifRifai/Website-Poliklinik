<?php
include "../koneksi.php";
// Gunakan middleware
require_once 'auth.php';
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



    <!-- Title -->
    <title>Dashboard Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Theme Check and Update -->
    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>

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
    <!-- ========== HEADER & SIDEBAR ========== -->
    <?php
    include 'sidebar.php';
    ?>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full h-full lg:ps-72 mt-2">
        <div id="dashboard" class="h-full scroll-mt-24 m-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Dashboard</h2>
        </div>
        <div class="flex flex-col md:flex-row md:gap-x-4 mx-4 lg:gap-x-4 justify-center">
            <!-- card1 -->
            <div class="card bg-base-100 w-full md:w-80 shadow-xl mx-auto transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex justify-between items-center">
                    <div class="m-8">
                        <i class="fa-solid fa-user" style="width: 96px; height: 96px; font-size: 96px;"></i>
                    </div>
                    <div class="m-8 text-center">
                        <h2 class="text-xl font-bold -ml-12">Total Pasien</h2>
                        <?php
                        // Query untuk menghitung jumlah data di tabel
                        $query = "SELECT COUNT(*) AS total_results FROM pasien";
                        $result = mysqli_query($conn, $query);

                        // Ambil hasil jumlah data
                        $row = mysqli_fetch_assoc($result);
                        $total_results = $row['total_results'];
                        ?>
                        <div>
                            <p class="text-6xl font-bold text-gray-600 dark:text-neutral-400 -ml-12">
                                <span class="font-semibold text-gray-800 dark:text-neutral-200"><?php echo $total_results; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="datapasien.php">
                    <div class="card-body flex flex-row justify-center items-center bg-info rounded-b-2xl py-2 cursor-pointer mt-2 transition-transform transform hover:scale-105">
                        <div class="flex flex-row items-center">
                            <h2 class="card-title text-center text-white text-xs sm:text-sm lg:text-xs">Lihat Detail</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- card2 -->
            <!-- Card 2 -->
            <div class="card bg-base-100 w-full md:w-80 shadow-xl mx-auto transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex justify-between items-center">
                    <div class="m-8">
                        <i class="fa-solid fa-user-doctor" style="width: 96px; height: 96px; font-size: 96px;"></i>
                    </div>
                    <div class="m-8 text-center">
                        <h2 class="text-xl font-bold -ml-12">Total Dokter</h2>
                        <?php
                        $query = "SELECT COUNT(*) AS total_results FROM dokter";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total_results = $row['total_results'];
                        ?>
                        <div>
                            <p class="text-6xl font-bold text-gray-600 dark:text-neutral-400 -ml-12">
                                <span class="font-semibold text-gray-800 dark:text-neutral-200"><?php echo $total_results; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="datadokter.php">
                    <div class="card-body flex flex-row justify-center items-center bg-info rounded-b-2xl py-2 cursor-pointer mt-2 transition-transform transform hover:scale-105">
                        <div class="flex flex-row items-center">
                            <h2 class="card-title text-center text-white text-xs sm:text-sm lg:text-xs">Lihat Detail</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="card bg-base-100 w-full md:w-80 shadow-xl mx-auto transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex justify-between items-center">
                    <div class="m-8">
                        <i class="fa-solid fa-user-astronaut" style="width: 96px; height: 96px; font-size: 96px;"></i>
                    </div>
                    <div class="m-8 text-center">
                        <h2 class="text-xl font-bold -ml-12">Total Admin</h2>
                        <?php
                        $query = "SELECT COUNT(*) AS total_results FROM tb_admin";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total_results = $row['total_results'];
                        ?>
                        <div>
                            <p class="text-6xl font-bold text-gray-600 dark:text-neutral-400 -ml-12">
                                <span class="font-semibold text-gray-800 dark:text-neutral-200"><?php echo $total_results; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="dataadmin.php">
                    <div class="card-body flex flex-row justify-center items-center bg-info rounded-b-2xl py-2 cursor-pointer mt-2 transition-transform transform hover:scale-105">
                        <div class="flex flex-row items-center">
                            <h2 class="card-title text-center text-white text-xs sm:text-sm lg:text-xs">Lihat Detail</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <!-- End Content -->


    <!-- JS Implementing Plugins -->

    <!-- JS PLUGINS -->
    <!-- Required plugins -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>

    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

</body>

</html>