<?php
$title = 'User Management';
ob_start();
?>

    <!-- Tambahkan konten halaman di sini -->
    <main id="main" class="main">
       
       <div class="pagetitle">
       <h1>Manajemen Pengguna</h1> 
    
       <nav>
           <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="home.php">Home</a></li>
           <li class="breadcrumb-item active">Manajemen Pengguna</li>
           </ol>
       </nav>
       </div><!-- End Page Title -->

       <section class="section">
           <div class="row">
               <div class="col-lg-12">

                   <div class="card">
                       <div class="card-body">
                           <h5 class="card-title">Tabel Pengguna</h5>
                           <!-- Tombol Tambah Data Pengguna -->
                           <div class="mb-3">
                               <a href="user_add.php" class="btn btn-success">Tambah Data Pengguna</a>
                           </div>

                           <!-- Table with stripped rows -->
                           <table class="table datatable">
                               <thead>
                                   <tr>
                                       <th>Full Name</th>
                                       <th>Username</th>
                                      
                                       <th>Level</th>
                                       <th>Aksi</th>
                                   </tr>
                               </thead>
                               <tbody>
                               <?php
                                   // Hubungkan ke database
                                   include '../../config/database.php';

                                   // Query untuk mendapatkan daftar pengguna
                                   $sql = "SELECT * FROM users";
                                   $result = $conn->query($sql);

                                   if ($result->num_rows > 0) {
                                       // Loop melalui setiap baris hasil
                                       while ($row = $result->fetch_assoc()) {
                                           echo "<tr>";
                                           echo "<td>" . $row['fullname'] . "</td>";
                                           echo "<td>" . $row['username'] . "</td>";
                                          
                                           echo "<td>";
                                               switch ($row['level']) {
                                                   case 0:
                                                       echo "Admin";
                                                       break;
                                                   case 1:
                                                       echo "HRD";
                                                       break;
                                                   case 2:
                                                       echo "Pimpinan";
                                                       break;
                                                   default:
                                                       echo "User";
                                                       break;
                                               }
                                           echo "</td>";
                                           // Tambahkan tombol edit dan delete
                                           echo "<td>
                                                   <a href='user_edit.php?id=" . $row['id_user'] . "' class='btn btn-primary'>Edit</a>
                                                   <a href='user_delete.php?id=" . $row['id_user'] . "' class='btn btn-danger'>Delete</a>
                                               </td>";
                                           echo "</tr>";
                                       }
                                   } else {
                                       // Jika tidak ada pengguna yang ditemukan
                                       echo "<tr><td colspan='5'>Tidak ada pengguna yang ditemukan</td></tr>";
                                   }
                               ?>
                               </tbody>
                           </table>
                           <!-- End Table with stripped rows -->

                       </div>
                   </div>

               </div>
           </div>
       </section>

   </main>
   <!-- End #main -->

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';
?>


 