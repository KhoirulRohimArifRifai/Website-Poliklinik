
# 🏥 Poliklinik Triharsi

Aplikasi manajemen poliklinik berbasis web untuk membantu pengelolaan data pasien, dokter, layanan medis, dan administrasi di Poliklinik Triharsi. Sistem ini terdiri dari dua level akses utama: **User** dan **Admin**.

## 🚀 Teknologi yang Digunakan

- **PHP Native**
- **Tailwind CSS** – styling modern dan responsif
- **JavaScript** – interaktivitas UI
- **HTML2PDF / DomPDF** *(atau tools lain)* – untuk generate bukti pendaftaran dalam format PDF

## 👥 Hak Akses Pengguna

### 🔹 User (Pasien)

User dapat mengakses halaman sistem informasi poliklinik untuk:

- Home (halaman utama)
- Registrasi Pasien
- Layanan Informasi Dokter
- Informasi Obat
- Informasi Umum Poliklinik
- Pendaftaran layanan poli  
  ⤷ Setelah berhasil daftar, user akan mendapatkan **bukti pendaftaran dalam bentuk PDF**

### 🔸 Admin

Admin memiliki akses khusus ke dashboard untuk mengelola data dan memantau aktivitas layanan:

- Manajemen Data Pasien (CRUD)
- Manajemen Dokter (CRUD)
- Manajemen Admin (CRUD)
- Data Obat (CRUD)
- Data Poli (CRUD)
- Laporan Pasien  
  ⤷ Bisa dilihat, dicetak, dan diunduh sesuai kebutuhan

## 📂 Struktur Direktori (Contoh)

```
/koneksi.php        -> file konfigurasi (database, helper, dll)
/admin/             -> halaman admin
/pdf/               -> generate PDF bukti pendaftaran
/images/            -> penyimpanan gambar umum
/imageobat/         -> penyimpanan gambar khusus obat
/index.php          -> halaman utama (routing awal)
/home.php           -> halaman utama user
/register.php       -> halaman registrasi pasien
/informasi.php      -> halaman informasi umum
/dokter.php         -> halaman informasi dokter
/obat.php           -> halaman informasi obat
```

## ⚙️ Cara Menjalankan Project

1. **Clone atau download** project ini
2. **Letakkan folder ke dalam direktori server lokal** (XAMPP/htdocs atau Laragon/www)
3. **Buat database baru**, lalu **import file SQL** yang disediakan
4. **Ubah konfigurasi database** di `koneksi.php`:
   ```php
   $host = 'localhost';
   $dbname = 'nama_database';
   $username = 'root';
   $password = '';
   ```
5. **Jalankan di browser:**
   ```
   http://localhost/poliklinik
   ```

## 👨‍💻 Developer

- Nama: Rifai
- Email: [khoirularif0102@gmail.com] 
- GitHub: [https://github.com/KhoirulRohimArifRifai]

## 📄 Lisensi

Project ini dibuat untuk keperluan UKK dan pembelajaran. Dilarang memperjualbelikan atau menyebarluaskan tanpa izin.
