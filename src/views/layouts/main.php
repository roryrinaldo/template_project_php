<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['id_user'])) {
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

   
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $title ?? 'My Project'; ?></title>

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
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
        <a href="home.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block " >Template Project</span>
        
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <!-- <img src="../public/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                <i class="bi bi-person "></i>
                <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['fullname'];?></span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            

                <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-gear"></i>
                    <span>Account Settings</span>
                </a>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

            

                <li>
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>

    <main>
        <?php echo $content; ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <?php include __DIR__ . '/../partials/script.php'; ?>
</body>
</html>

<?php
}else {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit;
}
?>