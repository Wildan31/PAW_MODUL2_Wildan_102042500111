<?php
require 'koneksi.php';


// =====================================================================
// TODO 1 - Mengambil data mobil yang akan diedit (mirip detail.php)
//   ___1a___ = nama parameter id di URL
//   ___1b___ = nama tabel mobil
//   ___1c___ = kolom primary key
// =====================================================================
$id = (int) ($_GET['id'] ?? 0);
$hasil = mysqli_query($conn,
    "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);
if (!$mobil) {
    exit('Mobil tidak ditemukan. Kembali ke daftar mobil.');
}


// =====================================================================
// TODO 2 - Nilai awal form diambil dari data lama
//   Isi key array dengan nama kolom tabel:
//   ___2a___ kode   ___2b___ nama   ___2c___ brand
//   ___2d___ warna  ___2e___ tipe   ___2f___ harga
// =====================================================================
$kode  = $mobil['kode_mobil'];
$nama  = $mobil['nama_mobil'];
$brand = $mobil['brand_mobil'];
$warna = $mobil['warna_mobil'];
$tipe  = $mobil['tipe_mobil'];
$harga = $mobil['harga_mobil'];
$pesan = '';


// =====================================================================
// TODO 3 - Cek apakah form sudah dikirim
//   ___3a___ = nilai atribut name pada <button> di form bawah
// =====================================================================
if (isset($_POST['simpan'])) {
    // Bagian ambil data + validasi sama seperti tambah.php (sudah lengkap).
    $kode  = mysqli_real_escape_string($conn, trim($_POST['kode_mobil']));
    $nama  = mysqli_real_escape_string($conn, trim($_POST['nama_mobil']));
    $brand = mysqli_real_escape_string($conn, trim($_POST['brand_mobil']));
    $warna = mysqli_real_escape_string($conn, trim($_POST['warna_mobil']));
    $tipe  = mysqli_real_escape_string($conn, trim($_POST['tipe_mobil']));
    $harga = trim($_POST['harga_mobil']);

    if ($kode == '' || $nama == '' || $brand == '' ||
        $warna == '' || $tipe == '') {
        $pesan = 'Semua kolom wajib diisi.';
    } elseif (!is_numeric($harga) || $harga <= 0 || $harga > 99999999999) {
        $pesan = 'Harga harus berupa angka positif, tanpa Rp dan titik.';
    } else {

        // =============================================================
        // TODO 4 - Cek kode kembar, KECUALI mobil yang sedang diedit
        //   ___4a___ = operator SQL "tidak sama dengan" (dua karakter: < dan >)
        // =============================================================
        $cek = mysqli_query($conn,
            "SELECT id FROM showroom_mobil
             WHERE kode_mobil = '$kode' AND id <> $id");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = 'Kode mobil sudah dipakai mobil lain.';
        } else {

            // =========================================================
            // TODO 5 - Menyimpan perubahan
            //   ___5a___ = perintah SQL untuk mengubah data
            //   ___5b___ = kata kunci sebelum daftar kolom = nilai
            //   ___5c___ = kolom primary key
            //   PENTING: tanpa WHERE, SEMUA mobil ikut berubah!
            // =========================================================
            mysqli_query($conn,
                "UPDATE showroom_mobil
                 SET kode_mobil = '$kode', nama_mobil = '$nama',
                     brand_mobil = '$brand', warna_mobil = '$warna',
                     tipe_mobil = '$tipe', harga_mobil = '$harga'
                 WHERE id = $id");
            header('Location: index.php?pesan=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit mobil - ShowRoom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><main>
<p class="label">SHOWROOM EAD</p>
<h1>Edit mobil</h1>
<p><a href="index.php">Kembali ke daftar</a></p>
<?php if ($pesan != ''): ?>
    <div class="kesalahan"><?= $pesan ?></div>
<?php endif; ?>
<form method="post">

    <!-- ===============================================================
         TODO 6 - Menampilkan nilai lama di input
           Isi dengan VARIABEL PHP (pakai tanda $) dari TODO 2:
           ___6a___ kode   ___6b___ nama   ___6c___ brand
           ___6d___ warna  ___6e___ tipe   ___6f___ harga
         =============================================================== -->
    <label for="kode">Kode mobil</label>
    <input id="kode" name="kode_mobil" maxlength="20" value="<?= $kode ?>">
    <label for="nama">Nama mobil</label>
    <input id="nama" name="nama_mobil" maxlength="100" value="<?= $nama ?>">
    <label for="brand">Brand</label>
    <input id="brand" name="brand_mobil" maxlength="50"
           value="<?= $brand ?>">
    <label for="warna">Warna</label>
    <input id="warna" name="warna_mobil" maxlength="30"
           value="<?= $warna ?>">
    <label for="tipe">Tipe (contoh: MPV, SUV, Sedan)</label>
    <input id="tipe" name="tipe_mobil" maxlength="20" value="<?= $tipe ?>">
    <label for="harga">Harga (angka saja, tanpa Rp dan titik)</label>
    <input id="harga" name="harga_mobil" value="<?= $harga ?>">

    <button name="simpan">Simpan perubahan</button>
</form>
</main></body>
</html>
