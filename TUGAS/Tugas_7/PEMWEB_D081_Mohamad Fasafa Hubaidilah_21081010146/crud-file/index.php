
<!DOCTYPE html>
<html>
  <head>
    <title>Buku Perpustakaan</title>
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
                <a class="nav-link active" href="<?php echo "index.php"; ?>">Data Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Buku</a>
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
                echo '<br><br><div class="alert alert-success" role="alert">Data berhasil di-update</div>';
              }
              else{
                echo '<br><br><div class="alert alert-danger" role="alert">'.$status.'</div>';
              }

            }
           ?>
          <h2 style="margin: 30px 0 30px 0;">Data Buku Perpustakaan</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>Jumlah Halaman</th>
                  <th>Kategori</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $filetemp = file('data.txt');
                  $no = 1;
                 ?>

                 <?php foreach($filetemp as $datos){ 
                  $data = explode('-', $datos);
                  ?>
                  <tr>
                    <td><?php echo $no;  ?></td>
                    <td><?php echo $data['0'];  ?></td>
                    <td><?php echo $data['1'];  ?></td>
                    <td><?php echo $data['2'];  ?></td>
                    <td><?php echo $data['3'];  ?></td>
                    <td><?php echo $data['4'];  ?></td>
                    <td><?php echo $data['5'];  ?></td>
                    <td><?php echo $data['6'];  ?></td>
                    <td><img src="upload/<?php echo $data['7'] ?>" height="200px" alt=""></td>
                    <td>
                      <a href="<?php echo "update.php?datos=".$datos; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "delete.php?datos=".$datos; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td>
                  </tr>
                 <?php $no++; } ?>
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

