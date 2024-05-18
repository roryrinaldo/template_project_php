<?php
include '../config/database.php';

// Fungsi untuk memeriksa apakah pengguna telah login
function isUserLoggedIn() {
    // Anda perlu menyesuaikan logika ini dengan sistem login Anda
    return isset($_SESSION['id_user']);
}

// Pemeriksaan login sebelum mengakses halaman
if (!isUserLoggedIn()) {
    // Jika pengguna belum login, arahkan mereka ke halaman login
    header("Location: ../src/views/login.php");
    exit; // Pastikan untuk keluar dari skrip setelah mengarahkan pengguna
}

?>