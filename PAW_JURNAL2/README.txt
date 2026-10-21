PAW MODUL 2 - JURNAL LMS SEDERHANA

Aplikasi ini mengelola mata kuliah, materi, dan tugas. Satu mata kuliah bisa punya
banyak materi dan banyak tugas. Tampilan, form, dan validasinya sudah jadi.
Bagian mata kuliah juga sudah jadi dan bisa dipakai sebagai contoh. Yang belum ada
adalah query untuk beranda, materi, dan tugas, dan itu tugas kalian.

PERSIAPAN
1. Pakai PHP 8.1 ke atas dan MySQL/MariaDB (XAMPP, Laragon, atau MAMP).
2. Taruh folder ini di htdocs (atau www kalau pakai Laragon).
3. Import database.sql lewat phpMyAdmin.
4. Buka connect.php, sesuaikan port, user, dan password dengan MySQL di laptop kalian.
5. Buka http://localhost/jurnal-paw-2-latihan/ di browser.
   Kalau tidak pakai Apache, jalankan "php -S 127.0.0.1:8080" dari dalam folder ini
   lalu buka http://127.0.0.1:8080.

Kalau angka di beranda masih 0 dan daftar materi/tugas masih kosong, itu normal.
Isinya baru muncul setelah TODO dikerjakan.

YANG DIKERJAKAN
Cari tulisan TODO di file berikut:

TODO 1  (RINGKASAN)     index.php         jumlah mata kuliah, materi, tugas, dan tugas aktif
TODO 2  (READ + JOIN)   materi.php        daftar materi, pencarian, filter mata kuliah
TODO 3  (CREATE)        materi.php        menyimpan materi baru
TODO 4  (UPDATE)        materi.php        menyimpan perubahan materi
TODO 5  (DELETE)        materi.php        menghapus materi
TODO 6  (READ + JOIN)   tugas.php         daftar tugas, pencarian, filter mata kuliah dan status
TODO 7  (CREATE)        tugas.php         menyimpan tugas baru
TODO 8  (UPDATE)        tugas.php         menyimpan perubahan tugas
TODO 9  (DELETE)        tugas.php         menghapus tugas
TODO 10 (RELASI)        mata_kuliah.php   mencegah mata kuliah dihapus selagi masih punya materi/tugas

Disarankan mengerjakan berurutan. Bagian tugas polanya mirip dengan materi,
jadi setelah TODO 2 sampai 5 selesai, TODO 6 sampai 9 akan terasa lebih cepat.

SUSUNAN FILE
Tiap jenis data punya satu file: mata_kuliah.php, materi.php, dan tugas.php.
Satu file melayani daftar, tambah, detail, edit, dan hapus sekaligus,
dibedakan lewat ?aksi= di URL. Contoh: materi.php?aksi=edit&id=1.
Di dalam file, bagian PHP di atas mengurus data, bagian HTML di bawah mengurus tampilan.

CONTOH YANG BISA DITIRU
- READ, CREATE, UPDATE, DELETE : mata_kuliah.php (cari komentar CONTOH)
- JOIN                         : fungsi cari_materi() dan cari_tugas() di functions.php

CARA CEK HASIL
- Beranda menampilkan 2 mata kuliah, 2 materi, 2 tugas, dan 1 tugas aktif.
- Daftar materi menampilkan 2 data lengkap dengan kode dan nama mata kuliahnya.
- Cari "crud" di materi hanya memunculkan 1 data. Filter mata kuliah ALP-101 juga 1 data.
- Daftar tugas urut dari tenggat terdekat. Filter status "Draf" hanya memunculkan 1 data.
- Tambah materi dan tugas baru, edit, lalu hapus. Pastikan data lain tidak ikut berubah.
- Coba hapus mata kuliah PAW-101. Harus ditolak dengan keterangan jumlah materi dan tugasnya.
- Buat mata kuliah baru tanpa materi/tugas, lalu hapus. Harus berhasil.
- Coba isi kolom pencarian dengan tanda petik satu ('). Halaman tidak boleh error.

CATATAN
- Semua query wajib memakai prepared statement.
- File selain yang ada TODO-nya tidak perlu diubah (kecuali isi koneksi di connect.php).
- Tenggat dan cara pengumpulan mengikuti arahan asisten/dosen.
