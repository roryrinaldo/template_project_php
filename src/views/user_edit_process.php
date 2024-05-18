<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['id_user'])) {

    // Hubungkan ke database
    include '../../config/database.php';

    // Periksa apakah form telah disubmit melalui method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Tangkap data yang dikirim melalui form
        $id_user = $_POST['id_user'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $level = $_POST['level'];

        // Query untuk mendapatkan informasi pengguna berdasarkan id_user
        $sql = "SELECT * FROM users WHERE id_user = $id_user";
        $result = $conn->query($sql);

        // Periksa apakah pengguna dengan id_user yang diberikan ditemukan
        if ($result && $result->num_rows == 1) {
            // Ambil data pengguna dari hasil query
            $row = $result->fetch_assoc();

            // Cek apakah password baru diinput
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            } else {
                // Gunakan password asli yang disimpan sebelumnya
                $password = $row['password'];
            }

            // Query untuk mengupdate data pengguna
            $updateSql = "UPDATE users SET fullname='$fullname', username='$username', password='$password', level=$level WHERE id_user = $id_user";
            if ($conn->query($updateSql) === TRUE) {
                echo "Data pengguna berhasil diperbarui";
                header("Location: user.php");
                exit;
            } else {
                echo "Error: " . $updateSql . "<br>" . $conn->error;
            }
        } else {
            // Jika pengguna dengan id_user yang diberikan tidak ditemukan
            echo "Pengguna tidak ditemukan";
        }
    } else {
        // Jika form tidak disubmit melalui method POST
        echo "Metode HTTP tidak valid";
    }
} else {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
}
?>