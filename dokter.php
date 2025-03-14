<?php
include "koneksi.php";

$query = "SELECT * FROM dokter ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dokter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <!-- Menyisipkan Navbar -->
    <?php include 'navbar.php'; ?>
    <div class="relative mt-20 overflow-hidden rounded-b-[50px]">
        <!-- Gambar dengan overlay gelap -->
        <img src="images/bgdokter.jpg" alt="bg" class="w-full h-[400px] object-cover">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Teks di tengah gambar -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-3xl font-bold">Informasi Dokter</h1>
                <p class="mt-2 text-lg">Temukan informasi lengkap tentang Dokter di sini</p>
            </div>
        </div>

        <!-- Div di paling bawah gambar -->
        <div class="absolute bottom-0 w-full h-[50px] bg-info rounded-b-[50px]"></div>
    </div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php while ($dokter = mysqli_fetch_assoc($result)): ?>
                <div class="group flex flex-col h-full bg-white border border-info border-2 shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="h-78 flex flex-col justify-center items-center rounded-t-xl overflow-hidden">
                        <img src="imagedokter/<?php echo $dokter['foto_dokter']; ?>"
                            alt="<?php echo $dokter['namadokter']; ?>"
                            class="w-[calc(100%-2rem)] h-full object-cover transition-transform duration-300 group-hover:scale-110 my-4 mx-4">
                    </div>
                    <div class="p-4 md:p-6">
                        <span class="block mb-1 text-xs font-semibold uppercase text-blue-600">
                            <?php echo $dokter['spesialis']; ?>
                        </span>
                        <h3 class="text-2xl font-semibold text-gray-800 group-hover:text-blue-600">
                            <?php echo $dokter['namadokter']; ?>
                        </h3>
                        <p class="mt-1 text-md text-gray-600">
                            <?php echo $dokter['jadwalhari']; ?>
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            <?php echo $dokter['jadwaljammulai']; ?> - <?php echo $dokter['jadwaljamselesai']; ?>
                        </p>
                    </div>
                    <div class="mt-auto flex border-t-2 border-info divide-x divide-gray-200">
                        <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-xl bg-white text-gray-800 shadow-sm hover:bg-gray-50" href="#">
                            View Details
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- End Grid -->
    </div>

</body>

</html>