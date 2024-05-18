<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['id_user'])) {
    // Ambil level pengguna dari sesi
    $user_level = $_SESSION['level'];
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="home.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <!-- Menu untuk Admin (Level 0) -->
        <?php if ($user_level == 0): ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/user.php">
                    <i class="bi bi-people"></i>
                    <span>User Management</span>
                </a>
            </li>

        <?php endif; ?>


    </ul>

</aside>
<!-- End Sidebar-->

<?php } ?>