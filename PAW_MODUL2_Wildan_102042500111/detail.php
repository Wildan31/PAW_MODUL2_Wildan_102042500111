<?php
require 'koneksi.php';


// =====================================================================
// TODO 1 - Mengambil id dari URL (contoh: detail.php?id=2)
//   ___1a___ = nama parameter di URL
//   (int) memaksa nilai menjadi angka; ?? 0 dipakai jika id tidak ada
// =====================================================================
$id = (int) ($_GET['id'] ?? 0);


// =====================================================================
// TODO 2 - Mengambil SATU mobil berdasarkan id
//   ___2a___ = nama tabel mobil
//   ___2b___ = kolom primary key
// =====================================================================
$hasil = mysqli_query($conn,
    "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);

// Jika id tidak ditemukan, $mobil bernilai null -> halaman dihentikan.
if (!$mobil) {
    exit('Mobil tidak ditemukan. Kembali ke daftar mobil.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail mobil - ShowRoom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><main>
<p class="label">SHOWROOM EAD / DETAIL</p>

<!-- ===================================================================
     TODO 3 - Menampilkan data (key = nama kolom di database.sql)
       ___3a___ nama   ___3b___ kode   ___3c___ brand
       ___3d___ warna  ___3e___ tipe   ___3f___ harga
     TODO 4 - Format Rupiah (contoh: Rp 310.000.000)
       ___4a___ = jumlah desimal  ___4b___ = pemisah desimal  ___4c___ = pemisah ribuan
     =================================================================== -->
<h1><?= $mobil['nama_mobil'] ?></h1>
<dl>
    <dt>Kode</dt><dd><?= $mobil['kode_mobil'] ?></dd>
    <dt>Brand</dt><dd><?= $mobil['brand_mobil'] ?></dd>
    <dt>Warna</dt><dd><?= $mobil['warna_mobil'] ?></dd>
    <dt>Tipe</dt><dd><?= $mobil['tipe_mobil'] ?></dd>
    <dt>Harga</dt>
    <dd>Rp <?= number_format($mobil['harga_mobil'], 0, ',', '.') ?></dd>
</dl>

<!-- ===================================================================
     TODO 5 - Link navigasi (isi nama file tujuan)
       ___5a___ = halaman daftar mobil
       ___5b___ = halaman edit
       ___5c___ = halaman hapus
     =================================================================== -->
<a href="index.php">Daftar mobil</a>
<a href="edit.php?id=<?= $id ?>">Edit mobil</a>
<a href="hapus.php?id=<?= $id ?>">Hapus mobil</a>
</main></body>
</html>
