<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'classicmodels' AND TABLE_NAME = 'products'";
      $r = mysqli_query(connection(),$q);
      while ($row = mysqli_fetch_array($r)) {
        ${$row['COLUMN_NAME']} = $_POST[$row['COLUMN_NAME']];
      }
      // while ($row = mysqli_fetch_array($r)) {
      //   $atribut[n] = '$atributPost['.$row["COLUMN_NAME"].']';
      //   $n++;
      // }
      // var_dump($atribut);
      // $atributPost = array();
      // while ($row = mysqli_fetch_array($r)) {
      //   $atribut[$row["COLUMN_NAME"]] = $_POST['COLUMN_NAME'];
      // }
      // var_dump($atributPost);

      // $nrp = $_POST['nrp'];
      // $nama = $_POST['nama'];
      // $jenis_kelamin = $_POST['jenis_kelamin'];
      // $alamat = $_POST['alamat'];
      //query SQL
      $query = "INSERT INTO products VALUES('$productCode','$productName','$productLine','$productScale','$productVendor','$productDescription','$quantityInStock','$buyPrice','$MSRP')"; 

      // //eksekusi query
      $result = mysqli_query(connection(),$query);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }
  }

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
                <a class="nav-link " href="<?php echo "index2.php"; ?>">Data Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "form2.php"; ?>">Tambah Data Produk</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Produk berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form Produk</h2>
          <form action="" method="POST">
            <?php 
              // $q = "SELECT * FROM customers";
              $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'classicmodels' AND TABLE_NAME = 'products'";
              $r = mysqli_query(connection(),$q);
              while ($row = mysqli_fetch_array($r)) {
            ?>
            <div class="form-group">
              <label><?php echo $row['COLUMN_NAME']; ?></label>
              <input type="text" class="form-control" placeholder="<?php echo $row['COLUMN_NAME']; ?>" name="<?php echo $row['COLUMN_NAME']; ?>" required="required">
            </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>