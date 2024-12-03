<?php
include "koneksi.php";

if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $nomorhp = $_POST['nomor'];
    $tgldaftar = $_POST['tanggal'];
    $poli = $_POST['poli'];

    mysqli_query($conn, "INSERT INTO pendaftaranpasien (nama, jeniskelamin, umur, alamat, email, nomorhp, tgldaftar, poli) 
        VALUES ('$nama', '$jeniskelamin', '$umur', '$alamat', '$email', '$nomorhp', '$tgldaftar', '$poli')");

    // Query untuk mengambil data dari tabel poli
}
$sql = "SELECT * FROM poli"; // Ganti 'poli' dengan nama tabel Anda
    $result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- header -->
    <!-- Menyisipkan Navbar -->
    <?php include 'navbar.php'; ?>
    <!--endheader-->


    <!-- Registration Form -->
    <!-- Hire Us -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-20">
        <!-- Grid -->
        <div class="grid md:grid-cols-2 items-center gap-12">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl lg:text-4xl lg:leading-tight dark:text-white">
                    Registrasi <span class="text-info">Layanan</span> Pasien
                </h1>
                <p class="mt-2 md:text-md text-gray-800 dark:text-neutral-200">
                    Silakan lengkapi biodata Anda pada formulir di samping untuk mendaftar sebagai pasien. Pastikan data yang Anda masukkan benar dan lengkap untuk mempermudah proses pendaftaran.
                </p>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        Apa yang akan di dapatkan?
                    </h2>

                    <ul class="mt-2 space-y-2">
                        <li class="flex gap-x-3">
                            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span class="text-gray-600 dark:text-neutral-400">
                                Pelayanan Terbaik
                            </span>
                        </li>

                        <li class="flex gap-x-3">
                            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span class="text-gray-600 dark:text-neutral-400">
                                Konsultasi dengan Tenaga Medis Profesional
                            </span>
                        </li>

                        <li class="flex gap-x-3">
                            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span class="text-gray-600 dark:text-neutral-400">
                                Informasi dan Edukasi Kesehatan
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Brands -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        by:
                    </h2>

                    <div class="mt-4 flex gap-x-8">
                        <img src="images/logoo.png" width="250dp">
                    </div>
                </div>
                <!-- End Brands -->

                <div class="mt-10 flex items-center gap-x-5">
                    <!-- Avatar Group -->
                    <div class="flex -space-x-2">
                        <img class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-neutral-900" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
                        <img class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-neutral-900" src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2.5&w=320&h=320&q=80" alt="Avatar">
                        <img class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-neutral-900" src="https://images.unsplash.com/photo-1541101767792-f9b2b1c4f127?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">
                        <span class="inline-flex justify-center items-center size-8 rounded-full bg-blue-600 text-white ring-2 ring-white">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </span>
                    </div>
                    <!-- End Avatar Group -->
                    <span class="text-sm text-gray-500 dark:text-neutral-500">
                        Dipercaya oleh lebih dari 2 ribu pasien
                    </span>
                </div>
            </div>
            <!-- End Col -->

            <div class="relative">
                <!-- Card -->
                <div class="flex flex-col border border-info rounded-xl border-2 p-4 sm:p-6 lg:p-10 dark:border-blue-500">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200 text-center">
                        Silahkan Isi Formulir
                    </h2>

                    <form action="" method="POST">
                        <div class="mt-6 grid gap-4 lg:gap-6">
                            <!-- Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" placeholder="Nama" class="input input-bordered input-info w-full max-w-lg">
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Jenis Kelamin</label>
                                    <select type="text" name="jeniskelamin" id="jeniskelamin" class="select select-info w-full max-w-lg">
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Grid -->
                            <!-- Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Umur</label>
                                    <input type="text" name="umur" id="umur" placeholder="Umur" class="input input-bordered input-info w-full max-w-lg">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Nomer HP</label>
                                    <input type="text" name="nomor" id="nomor" placeholder="Nomor HP" class="input input-bordered input-info w-full max-w-lg">
                                </div>
                            </div>
                            <!-- End Grid -->
                            <!-- Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Tanggal Daftar</label>
                                    <input type="date" name="tanggal" id="tanggal" class="input input-bordered input-info w-full max-w-lg">
                                    <p id="formatted-date" class="mt-2 text-sm text-gray-500 dark:text-neutral-400"></p>
                                </div>


                                <div>
                                    <label class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Pilihan Poli</label>
                                    <select type="text" name="poli" id="poli" class="select select-info w-full max-w-lg ">
                                        <option disabled selected>Pilih Poli</option>
                                        <?php
                                        // Periksa apakah ada data
                                        if ($result->num_rows > 0) {
                                            // Loop untuk menampilkan setiap data poli
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["id"] . "'>" . $row["namapoli"] . "</option>";
                                            }
                                        } else {
                                            echo "<option disabled>Tidak ada data</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- End Grid -->
                        </div>
                    </form>
                    <!-- End Grid -->

                    <!-- Checkbox -->
                    <div class="mt-3 flex">
                        <div class="flex">
                            <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-1.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        </div>
                        <div class="ms-3">
                            <label for="remember-me" class="text-sm text-gray-600 dark:text-neutral-400">Dengan mengirimkan formulir ini saya telah membaca dan menyetujui <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">Kebijakan Privasi</a></label>
                        </div>
                    </div>
                    <!-- End Checkbox -->

                    <div class="mt-6 grid">
                        <button type="submit" id="buttondaftar" name="daftar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Daftar</button>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Hire Us -->
</body>

<script>
    //date
    document.getElementById('tanggal').addEventListener('change', function(event) {
        const inputDate = event.target.value; // Format asli (yyyy-mm-dd)

        if (inputDate) {
            // Konversi string menjadi objek Date
            const dateObj = new Date(inputDate);

            // Array nama hari dan bulan
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Ambil nama hari, tanggal, bulan, dan tahun
            const dayName = days[dateObj.getDay()];
            const day = dateObj.getDate();
            const monthName = months[dateObj.getMonth()];
            const year = dateObj.getFullYear();

            // Format akhir: Hari, Tanggal Bulan Tahun
            const formattedDate = `${dayName}, ${day} ${monthName} ${year}`;

            // Tampilkan hasil format
            document.getElementById('formatted-date').textContent = `Jadwal Anda: ${formattedDate}`;
        } else {
            // Kosongkan jika tidak ada tanggal
            document.getElementById('formatted-date').textContent = '';
        }
    });


    //email address
    document.getElementById("buttondaftar").addEventListener("click", function(event) {
        // Mencegah form submit default jika diperlukan
        event.preventDefault();

        // Array field wajib diisi (tanpa alamat dan email)
        const requiredFields = ["nama", "jeniskelamin", "umur", "nomor", "tanggal", "poli"];
        const emptyFields = [];

        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field && !field.value.trim()) {
                emptyFields.push(fieldId);
            }
        });

        if (emptyFields.length > 1) {
            // Jika lebih dari satu field kosong
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Lengkapi semua formulir.',
            });
        } else if (emptyFields.length === 1) {
            // Jika hanya satu field kosong
            const fieldName = emptyFields[0];
            const fieldNamesMap = {
                nama: 'Harap masukkan nama Anda.',
                jeniskelamin: 'Harap pilih jenis kelamin.',
                umur: 'Harap masukkan umur Anda.',
                nomor: 'Harap masukkan nomor telepon Anda.',
                tanggal: 'Harap pilih tanggal.',
                poli: 'Harap pilih poli.'
            };

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: fieldNamesMap[fieldName] || 'Harap isi bidang ini.',
            });
        } else {
            // Jika tidak ada field kosong
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Semua formulir sudah lengkap.',
            });
            // Lanjutkan ke proses form submission
            // document.getElementById('form-id').submit(); // Uncomment jika menggunakan form HTML
        }
    });
</script>

</html>