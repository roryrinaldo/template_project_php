<?php
// Hubungkan ke database
include '../../config/database.php';

// Inisialisasi session (jika belum ada)
session_start();
$error_message = '';

// Cek apakah pengguna sudah login, jika ya, arahkan ke halaman utama
if (isset($_SESSION['id_user'])) {
    header("Location: ../views/home.php");
    exit;
}


// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Jika kredensial valid, atur session dan arahkan ke halaman utama
    // Contoh sederhana untuk tujuan demonstrasi
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query database untuk mendapatkan informasi pengguna
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Jika username ditemukan dalam database
        $row = $result->fetch_assoc();
        // Periksa apakah password cocok
        if (password_verify($password, $row['password'])) {
            // Jika cocok, atur session untuk menandakan bahwa pengguna telah login
            $_SESSION['id_user'] = $row['id_user']; // Anda bisa menyimpan informasi pengguna lainnya di sesi jika diperlukan
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['level'] = $row['level'];
            header("Location: ../views/home.php");
            exit;
        } else {
            // Jika password tidak cocok, tampilkan pesan kesalahan
            $error_message = "password salah.";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan kesalahan
        $error_message = "Username atau password tidak tersedia.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../public/assets/img/favicon.png" rel="icon">
  <link href="../../public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../public/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../public/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="home.php" class="logo d-flex align-items-center w-auto">
                  <!-- <img src="../public/img/logo.png" alt="" > -->
                  <span class="d-none d-lg-block" >Template Project</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
                    <?php if (isset($error_message)) { ?>
                        <p><?php echo $error_message; ?></p>
                    <?php } ?>
                    <form class="row g-3 needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                        
                          <input type="text" name="username" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please enter your username.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group">
                          <input type="password" name="password" class="form-control" id="yourPassword" required>
                          <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>

                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                          <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                      </div>

                    </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../public/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../public/assets/vendor/quill/quill.min.js"></script>
  <script src="../../public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../public/assets/js/main.js"></script>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('yourPassword');
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

</body>

</html>