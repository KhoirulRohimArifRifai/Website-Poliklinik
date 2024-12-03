<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- header -->
    <div class="navbar bg-base-100 navbar fixed top-0 left-0 w-full z-50 border-b-4 border-blue-500">
        <div class="navbar-start lg:pl-24 ">
            <a href="#home">
                <img src="images/logoo.png" alt="logo" class="img-fluid m-4">
            </a>
            <!-- navbar small -->
            <div class="navbar-end lg:hidden flex justify-end">
                <div class="dropdown navbar-end lg:hidden">
                    <div tabindex="0" role="button" class="btn btn-ghost hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul
                        tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li><a>Beranda</a></li>
                        <details>
                            <summary>Layanan</summary>
                            <ul class="p-2">
                                <li><a>Konsultasi Dokter</a></li>
                                <li><a>Informasi Obat Obatan</a></li>
                                <li><a>Jadwal Dokter</a></li>
                            </ul>
                        </details>
                        <li><a>Blog Kesehatan</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- navbar mode lg -->
        <div class="navbar-end lg:pr-28 hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a class="text-lg hover:text-white hover:bg-info p-2 rounded" href="#home">Beranda</a></li>
                <li><a class="text-lg hover:text-white hover:bg-info p-2 rounded" href="daftarpasien.php">Registrasi Pasien</a></li>
                <li>
                    <details>
                        <summary class="text-lg hover:text-white hover:bg-info p-2 rounded">Layanan</summary>
                        <ul class="p-2">
                            <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Konsultasi Dokter</a></li>
                            <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Informasi Obat Obatan</a></li>
                            <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Jadwal Dokter</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="blog.php" class="text-lg hover:text-white hover:bg-info p-2 rounded">Blog Kesehatan</a></li>
            </ul>
        </div>
    </div>
    <!--endheader-->
</body>

</html>