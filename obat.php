<?php
include "koneksi.php";

$query = "SELECT * FROM obat ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obat Obatan</title>
</head>

<body>
    <!-- Menyisipkan Navbar -->
    <?php include 'navbar.php'; ?>
    <!--endheader-->
    <!-- Card Blog -->
    <div class="relative mt-20">
        <!-- Gambar dengan overlay gelap -->
        <img src="images/bgobat.jpg" alt="bg" class="w-full h-[400px] object-cover">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Teks di tengah gambar -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-3xl font-bold">Informasi Obat-Obatan</h1>
                <p class="mt-2 text-lg">Temukan informasi lengkap tentang obat-obatan di sini</p>
            </div>
        </div>

        <!-- Div di paling bawah gambar -->
        <div class="absolute bottom-0 w-full h-[50px] bg-info"></div>
    </div>


    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($obat = mysqli_fetch_assoc($result)): ?>
                <div class="group flex flex-col h-full bg-white border border-info border-2 shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="h-52 flex flex-col justify-center items-center bg-blue-600 rounded-t-xl overflow-hidden">
                        <img src="imageobat/<?php echo $obat['gambar_obat']; ?>" alt="<?php echo $obat['nama_obat']; ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="p-4 md:p-6">
                        <span class="block mb-1 text-xs font-semibold uppercase text-blue-600">
                            <?php echo $obat['jenis_obat']; ?>
                        </span>
                        <h3 class="text-2xl font-semibold text-gray-800 group-hover:text-blue-600">
                            <?php echo $obat['nama_obat']; ?>
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            <?php echo $obat['dosis']; ?> - <?php echo $obat['ukuran_obat']; ?>
                        </p>
                        <p class="mt-3 text-gray-500">
                            <?php echo substr($obat['deskripsi'], 0, 70); ?>...
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
    <!-- End Card Blog -->
</body>

</html>