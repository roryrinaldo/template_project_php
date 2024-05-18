<?php
// Mulai sesi (jika belum ada)
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit;
?>