<?php
require 'koneksi.php';

// Ambil data mobil dulu supaya bisa ditampilkan di halaman konfirmasi
// (bagian ini sudah lengkap, sama seperti detail.php).
$id = (int) ($_GET['id'] ?? 0);
$hasil = mysqli_query($conn,
    "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);
if (!$mobil) {
    exit('Mobil tidak ditemukan. Kembali ke daftar mobil.');
}


// =====================================================================
// TODO 1 - Hapus hanya saat tombol konfirmasi ditekan
//   ___1a___ = nilai atribut name pada <button> di form bawah
// TODO 2 - Perintah SQL hapus
//   ___2a___ ___2b___ = dua kata perintah SQL hapus data
//   ___2c___          = kolom primary key
//   PENTING: tanpa WHERE, SEMUA mobil ikut terhapus!
// =====================================================================
if (isset($_POST['hapus'])) {
    mysqli_query($conn, "DELETE,  FROM showroom_mobil WHERE id = $id");
    header('Location: index.php?pesan=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus mobil - ShowRoom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><main>
<p class="label">SHOWROOM EAD / KONFIRMASI</p>
<h1>Hapus mobil?</h1>

<!-- ===================================================================
     TODO 3 - Tampilkan mobil yang akan dihapus
       ___3a___ = kolom nama mobil   ___3b___ = kolom kode mobil
     =================================================================== -->
<p><?= $mobil['nama_mobil'] ?>
   (<?= $mobil['kode_mobil'] ?>) akan dihapus.</p>
<p>Data yang sudah dihapus tidak bisa dikembalikan.</p>

<!-- ===================================================================
     TODO 4 - Method form
       ___4a___ = get atau post? (aksi ini mengubah data)
     TODO 5 - Tombol konfirmasi
       ___5a___ = harus SAMA dengan ___1a___ di isset() atas
       ___5b___ = class tombol merah (cari di style.css)
     TODO 6 - Tombol batal
       ___6a___ = kembali ke halaman detail mobil ini
     =================================================================== -->
<form method="post">
    <button name="post" class="bahaya">Ya, hapus mobil</button>
    <a href="detail.php?id=<?= $id ?>">Batal</a>
</form>
</main></body>
</html>
