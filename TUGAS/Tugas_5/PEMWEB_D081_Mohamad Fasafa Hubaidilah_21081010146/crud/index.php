<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');
  $table = $_GET['table'];
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
              <?php 
                $qTable = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA='$dbName'";
                $rTable = mysqli_query(connection(),$qTable);
                while ($rowTable = mysqli_fetch_array($rTable)) {
              ?>
                <li class="nav-item">
                  <a class="nav-link <?php echo $rowTable['TABLE_NAME'] == $table ? "active" : "" ?>" href="<?php echo "index.php?table=$rowTable[TABLE_NAME]"; ?>">Data <?php echo ucwords($rowTable['TABLE_NAME']) ?></a>
                </li>
              <?php } ?>
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h2 style="margin: 30px 0 30px 0;">Data <?= ucwords($table) ?></h2>
            </div>
            <div class="col-sm-6">
              <div class="float-sm-right">
                <a style="margin: 30px 0 30px 0;" href="<?php echo "form.php?table=".$table ?>" class="btn btn-primary">+ Tambah <?= ucwords($table) ?></a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <?php
                    $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
                    $r = mysqli_query(connection(),$q);
                    $kolom = array();
                    while($row = mysqli_fetch_array($r)){
                      $kolom[] = $row;
                    }
                    foreach($kolom as $atribut){ 
                      $qCekFk = "SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_NAME='$atribut[COLUMN_NAME]' AND REFERENCED_TABLE_NAME IS NOT NULL";
                      $rCekFk = mysqli_query(connection(),$qCekFk);
                      $rowCek = mysqli_fetch_array($rCekFk);
                      // $qCekFk .=
                      // $qCekFk .=
                      // $qCekFk .=
                      // var_dump($rowCek == null);
                      ?>
                      <th><?= ucwords(preg_replace("([A-Z])", " $0", $atribut['COLUMN_NAME'])) ?></th>
                  <?php } ?>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
                  $r = mysqli_query(connection(),$q);
                  $query = "SELECT * FROM $table";
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <?php foreach($kolom as $atribut){?>
                        <td><?php echo $data[$atribut['COLUMN_NAME']];  ?></td>
                    <?php } ?>
                    <td>
                      <a href="<?php echo "update.php?table=".$table."&".$kolom['0']['COLUMN_NAME']."=".$data[$kolom['0']['COLUMN_NAME']]; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "delete.php?table=".$table."&".$kolom['0']['COLUMN_NAME']."=".$data[$kolom['0']['COLUMN_NAME']]; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td>
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

