<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poliklinik</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>

    <body>
        <!-- header -->
        <div class="navbar bg-base-100 fixed top-0 left-0 w-full z-50 border-b-4 border-blue-500 shadow-md">
    <div class="navbar-start lg:pl-24">
        <a href="#home">
            <img src="images/logoo.png" alt="logo" class="h-10 w-auto m-4">
        </a>
    </div>

    <!-- navbar small -->
    <div class="navbar-end lg:hidden">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost focus:outline-none">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0" class="dropdown-content menu p-4 shadow-xl rounded-lg bg-white w-64 mt-4 right-0 transition duration-300 ease-in-out transform origin-top-right">
                <li>
                    <a href="index.php" class="block text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-3 transition duration-300">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="daftarpasien.php" class="block text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-3 transition duration-300">
                        Resgister Pasien
                    </a>
                </li>
                <li tabindex="0">
                    <details class="group">
                        <summary class="flex items-center justify-between cursor-pointer text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-3 transition duration-300">
                            <span>Layanan</span>
                            <!-- <svg class="h-4 w-4 text-gray-600 group-open:rotate-180 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg> -->
                        </summary>
                        <ul class="ml-4 mt-2 space-y-2 transition duration-300 ease-in-out transform origin-top-right group-open:scale-100 scale-0">
                            <li><a class="block text-gray-700 hover:text-blue-600 transition">Konsultasi Dokter</a></li>
                            <li><a class="block text-gray-700 hover:text-blue-600 transition">Informasi Obat Obatan</a></li>
                            <li><a class="block text-gray-700 hover:text-blue-600 transition">Jadwal Dokter</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <a href="blog.php" class="block text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-3 transition duration-300">
                        Blog Kesehatan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- navbar mode lg -->
    <div class="navbar-end lg:pr-28 hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a class="text-lg hover:text-white hover:bg-info p-2 rounded" href="index.php">Beranda</a></li>
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