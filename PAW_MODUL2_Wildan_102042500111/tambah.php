<?php
require 'koneksi.php';

$kode = $nama = $brand = $warna = $tipe = $harga = '';
$pesan = '';


// =====================================================================
// TODO 1 - Cek apakah form sudah dikirim
//   ___1a___ = nilai atribut name pada <button> di form bawah
// =====================================================================
if (isset($_POST['simpan'])) {

    // =================================================================
    // TODO 2 - Mengambil isi form
    //   Isi dengan nilai atribut name tiap <input> (= nama kolom tabel):
    //   ___2a___ kode   ___2b___ nama   ___2c___ brand
    //   ___2d___ warna  ___2e___ tipe   ___2f___ harga
    //   trim() = buang spasi di awal/akhir
    //   mysqli_real_escape_string() = amankan tanda kutip agar query tidak rusak
    // =================================================================
    $kode  = mysqli_real_escape_string($conn, trim($_POST['kode_mobil']));
    $nama  = mysqli_real_escape_string($conn, trim($_POST['nama_mobil']));
    $brand = mysqli_real_escape_string($conn, trim($_POST['brand_mobil']));
    $warna = mysqli_real_escape_string($conn, trim($_POST['warna_mobil']));
    $tipe  = mysqli_real_escape_string($conn, trim($_POST['tipe_mobil']));
    $harga = trim($_POST['harga_mobil']);


    // =================================================================
    // TODO 3 - Validasi kolom kosong
    //   ___3a___ = string kosong. Ganti '___3a___' menjadi '' (dua kutip
    //   tanpa isi) di kelima tempat.
    // =================================================================
    if ($kode == '' || $nama == '' || $brand == '' ||
        $warna == '' || $tipe == '') {
        $pesan = 'Semua kolom wajib diisi.';

    // =================================================================
    // TODO 4 - Validasi harga
    //   ___4a___ = fungsi PHP untuk cek apakah nilai berupa angka (is_...)
    //   ___4b___ = batas bawah; harga harus lebih besar dari angka ini
    // =================================================================
    } elseif (!is_numeric($harga) || $harga <= 0 || $harga > 99999999999) {
        $pesan = 'Harga harus berupa angka positif, tanpa Rp dan titik.';
    } else {

        // =============================================================
        // TODO 5 - Cek kode mobil kembar
        //   ___5a___ = kolom yang menyimpan kode mobil
        //   ___5b___ = jika jumlah baris LEBIH DARI angka ini, kode sudah ada
        // =============================================================
        $cek = mysqli_query($conn,
            "SELECT id FROM showroom_mobil WHERE kode_mobil = '$kode'");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = 'Kode mobil sudah dipakai.';
        } else {

            // =========================================================
            // TODO 6 - Menyimpan data baru
            //   ___6a___ ___6b___ = dua kata perintah SQL tambah data
            //   ___6c___          = kata kunci sebelum daftar nilai
            //   Urutan nilai harus sama dengan urutan kolom.
            // =========================================================
            mysqli_query($conn,
                "INSERT, INTO, showroom_mobil
                 (kode_mobil, nama_mobil, brand_mobil, warna_mobil,
                  tipe_mobil, harga_mobil)
                 VALUES ('$kode', '$nama', '$brand', '$warna',
                         '$tipe', '$harga')");

            // =========================================================
            // TODO 7 - Kembali ke daftar mobil
            //   ___7a___ = halaman daftar + parameter pesan bernilai 1
            //              (format: namafile.php?parameter=nilai)
            // =========================================================
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
    <title>Tambah mobil - ShowRoom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><main>
<p class="label">SHOWROOM EAD</p>
<h1>Tambah mobil</h1>
<p><a href="index.php">Kembali ke daftar</a></p>
<?php if ($pesan != ''): ?>
    <div class="kesalahan"><?= $pesan ?></div>
<?php endif; ?>

<!-- ===================================================================
     TODO 8 - Method form
       ___8a___ = get atau post? (data disimpan, jangan tampil di URL)
     =================================================================== -->
<form method="post">

    <!-- ===============================================================
         TODO 9 - Atribut input
           name      = nama kolom tabel (sama dengan TODO 2)
           maxlength = panjang VARCHAR kolom itu di database.sql
           ___9a___ / ___9b___ = name / maxlength kode
           ___9c___ / ___9d___ = name / maxlength nama
           ___9e___ / ___9f___ = name / maxlength brand
           ___9g___ / ___9h___ = name / maxlength warna
           ___9i___ / ___9j___ = name / maxlength tipe
           ___9k___            = name harga
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

    <!-- ===============================================================
         TODO 10 - Tombol simpan
           ___10a___ = harus SAMA dengan ___1a___ di isset() atas
         =============================================================== -->
    <button name="simpan">Simpan mobil</button>
</form>
</main></body>
</html>
