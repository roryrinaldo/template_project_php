<?php
// Hubungkan ke database
include '../../config/database.php';

// Periksa apakah parameter id_user telah diterima
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Tangkap nilai id_user dari parameter URL
    $id_user = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan id_user
    $sql = "DELETE FROM users WHERE id_user = $id_user";

    // Lakukan proses penghapusan pengguna
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lain setelah proses penghapusan selesai
        header("Location: user.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat menghapus pengguna, tampilkan pesan kesalahan atau redirect ke halaman error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Jika parameter id_user tidak diberikan, tampilkan pesan kesalahan atau redirect ke halaman error
    echo "Parameter id_user tidak diberikan.";
}
?>