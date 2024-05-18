<?php
$title = 'User Management';
ob_start();

    // Hubungkan ke database
    include '../../config/database.php';

    // Periksa apakah form telah disubmit melalui method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Tangkap data yang dikirim melalui form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $level = $_POST['level'];

        // Cek apakah password baru diinput dan lakukan hash password
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            // Tampilkan pesan kesalahan jika password kosong
            echo "Error: Password tidak boleh kosong";
            exit; // Berhenti eksekusi skrip
        }

        // Query untuk menambahkan data pengguna
        $addSql = "INSERT INTO users (fullname, username, password, level) VALUES ('$fullname', '$username', '$password', $level)";
        if ($conn->query($addSql) === TRUE) {
            echo "Data pengguna berhasil ditambahkan";
            header("Location: user.php");
            exit;
        } else {
            echo "Error: " . $addSql . "<br>" . $conn->error;
        }
    }
?>

    <!-- Tambahkan konten halaman di sini -->
    <main id="main" class="main">
       
       <div class="pagetitle">
       <h1>Manajemen Pengguna</h1> 
    
       <nav>
           <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="home.php">Home</a></li>
           <li class="breadcrumb-item">Manajemen Pengguna</li>
           <li class="breadcrumb-item active">Tambah Pengguna</li>
           </ol>
       </nav>
       </div><!-- End Page Title -->

       
       <section class="section">
           <div class="row">
               <div class="col-lg-12">
                   <div class="card">
                       <div class="card-body">
                           <h5 class="card-title">Tambah Pengguna</h5>

                           <!-- Form Edit Pengguna -->
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                               <div class="mb-3">
                                   <label for="inputFullName" class="form-label">Full Name</label>
                                   <input type="text" class="form-control" id="inputFullName" name="fullname" required >
                               </div>
                               <div class="mb-3">
                                   <label for="inputUsername" class="form-label">Username</label>
                                   <input type="text" class="form-control" id="inputUsername" name="username" required >
                               </div>
                               <div class="mb-3">
                                   <label for="inputPassword" class="form-label">Password</label>
                                   <div class="input-group">
                                       <input type="password" class="form-control" id="inputPassword" name="password" required >
                                       <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                         <i class="bi bi-eye"></i>
                                       </button>
                                   </div>
                               </div>
                               <div class="mb-3">
                                   <label for="inputLevel" class="form-label">Level</label>
                                   <select class="form-select" id="inputLevel" name="level" required>
                                       <option value="0">Admin</option>
                                       <option value="1">User</option>
                                       <option value="2">Lainnya</option>
                                   </select>
                               </div>
                               
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
$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';
?>