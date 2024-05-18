<?php
$title = 'User Management';
ob_start();

// Hubungkan ke database
include '../../config/database.php';

// Periksa apakah parameter id_user telah diterima dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Tangkap nilai id_user dari parameter URL
    $id_user = $_GET['id'];

    // Query untuk mendapatkan informasi pengguna berdasarkan id_user
    $sql = "SELECT * FROM users WHERE id_user = $id_user";
    $result = $conn->query($sql);

    // Periksa apakah pengguna dengan id_user yang diberikan ditemukan
    if ($result && $result->num_rows == 1) {
        // Ambil data pengguna dari hasil query
        $row = $result->fetch_assoc();

?>

    <!-- Tambahkan konten halaman di sini -->
    <main id="main" class="main">
        
        <div class="pagetitle">
        <h1>Manajemen Pengguna</h1> 
        
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item">Manajemen Pengguna</li>
            <li class="breadcrumb-item active">Edit Pengguna</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Pengguna</h5>

                            <!-- Form Edit Pengguna -->
                            <form action="user_edit_process.php" method="POST">
                                <div class="mb-3">
                                    <label for="inputFullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="inputFullName" name="fullname" required value="<?php echo $row['fullname']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="inputUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="inputUsername" name="username" required value="<?php echo $row['username']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="inputPassword" name="password" >
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputLevel" class="form-label">Level</label>
                                    <select class="form-select" id="inputLevel" name="level" required>
                                        <option value="0" <?php echo ($row['level'] == 0) ? 'selected' : ''; ?>>Admin</option>
                                        <option value="1" <?php echo ($row['level'] == 1) ? 'selected' : ''; ?>>User</option>
                                        <option value="2" <?php echo ($row['level'] == 2) ? 'selected' : ''; ?>>Lainnya</option>
                                    </select>
                                </div>
                                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                
                                <a href="user.php" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form><!-- End Form Edit Pengguna -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('inputPassword');
            const passwordIcon = document.querySelector('#togglePassword i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    </script>

    <?php
    } else {
        // Jika pengguna dengan id_user yang diberikan tidak ditemukan
        echo "Pengguna tidak ditemukan";
    }
} else {
    // Jika parameter id tidak diterima atau kosong
    echo "Parameter id tidak valid";
}


$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';
?>



