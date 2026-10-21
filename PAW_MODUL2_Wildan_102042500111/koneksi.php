<?php
// Sesuaikan akun, sandi, dan nama database dengan komputer Anda.
// 127.0.0.1 memakai port TCP yang sama di Windows dan Mac.


// =====================================================================
// TODO 1 - Membuat koneksi ke database MySQL
// Ganti setiap ___1x___ (termasuk garis bawahnya) dengan nilai yang benar:
//   ___1a___ = alamat host     -> komputer sendiri: 127.0.0.1
//   ___1b___ = username MySQL  -> bawaan XAMPP/Laragon: root
//   ___1c___ = password MySQL  -> bawaan XAMPP/Laragon: kosong, jadi tulis ''
//   ___1d___ = nama database   -> lihat baris CREATE DATABASE di database.sql
// =====================================================================
$conn = mysqli_connect('127.0.0.1', 'root', 'Wildan', 'paw_modul2_showroom');

// =====================================================================
// TODO 2 - Mengatur charset koneksi
//   ___2a___ = nama charset -> samakan dengan CHARACTER SET di database.sql
// =====================================================================
mysqli_set_charset($conn, 'utf8mb4');
