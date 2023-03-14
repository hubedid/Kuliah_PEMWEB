<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Example</title>
    <!-- load css boostrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Pemrograman Web</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
               <li class="nav-item">
                <a class="nav-link" href="<?php echo "index.php"; ?>">Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "index2.php"; ?>">Data Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form2.php"; ?>">Tambah Data Produk</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Mahasiswa berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Mahasiswa gagal di-update</div>';
              }

            }
           ?>
          <h2 style="margin: 30px 0 30px 0;">Mahasiswa</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>productCode</th>
                  <th>productName</th>
                  <th>productLine</th>
                  <th>productScale</th>
                  <th>productVendor</th>
                  <th>productDescription</th>
                  <th>quantityInStock</th>
                  <th>buyPrice</th>
                  <th>MSRP</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM products";
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?php echo $data['productCode'];  ?></td>
                    <td><?php echo $data['productName'];  ?></td>
                    <td><?php echo $data['productLine'];  ?></td>
                    <td><?php echo $data['productScale'];  ?></td>
                    <td><?php echo $data['productVendor'];  ?></td>
                    <td><?php echo $data['productDescription'];  ?></td>
                    <td><?php echo $data['quantityInStock'];  ?></td>
                    <td><?php echo $data['buyPrice'];  ?></td>
                    <td><?php echo $data['MSRP'];  ?></td>
                    <!-- <td>
                      <a href="<?php //echo "update.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php //echo "delete.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td> -->
                  </tr>
                 <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>

