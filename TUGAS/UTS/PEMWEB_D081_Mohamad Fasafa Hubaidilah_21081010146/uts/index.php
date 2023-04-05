<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');
  $table = isset($_GET['table']) ? $_GET['table'] : 'bus';
  if($table == 'gajiDriver'){
    include ('pendapatanDriver.php');
  }else if($table == 'gajiKondektur'){
    include ('pendapatanKondektur.php');
  }else{
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UTS</title>
    <!-- load css boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                  <a class="nav-link <?php echo $rowTable['TABLE_NAME'] == $table ? "active" : "" ?>" href="<?php echo "index.php?table=$rowTable[TABLE_NAME]"; ?>">Data <?php echo ucwords(preg_replace("(_)", " ", $rowTable['TABLE_NAME'])) ?></a>
                </li>
              <?php } ?>
              <li class="nav-item">
                <a class="nav-link <?php echo "gajiDriver" == $table ? "active" : "" ?>" href="<?php echo "index.php?table=gajiDriver"; ?>">Pendapatan Driver</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo "gajiKondektur" == $table ? "active" : "" ?>" href="<?php echo "index.php?table=gajiKondektur"; ?>">Pendapatan Kondektur</a>
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h2 style="margin: 30px 0 30px 0;">Data <?= ucwords(preg_replace("(_)", " ", $table)) ?></h2>
            </div>
            <div class="col-sm-6">
              <div class="float-sm-right">
                <a style="margin: 30px 0 30px 0;" href="<?php echo "form.php?table=".$table ?>" class="btn btn-primary">+ Tambah <?= ucwords(preg_replace("(_)", " ", $table)) ?></a>
              </div>
            </div>
          </div>
          <?php if($table == "bus"): if(isset($_GET['filter'])){ echo '<h4> Status = '.($_GET['filter'] == 1 ? "Aktif" : ($_GET['filter'] == 2 ? "Cadangan" : ($_GET['filter'] == 0 ? "Rusak" : "Semua"))).'</h4>'; } else{ echo '<h4> Status = Semua </h4>'; }?>
            <form action="" method="GET">
              <input type="hidden" name="table" value="<?php echo $table ?>">
              <div class="form-group">
                <select name="filter" class="form-select" aria-label="Default select example">
                  <option disabled selected>Pilih Filter Status</option>
                  <option value="1">Aktif</option>
                  <option value="2">Cadangan</option>
                  <option value="0">Rusak</option>
                  <option value="999">ALL</option>
                </select>
                <button type="submit">Filter</button>
                <a href="index.php?table=<?php echo $table ?>"><button type="button" class="button reset">Reset</button></a>
              </div>
            </form>
          <?php elseif($table == "trans_upn"): if(isset($_GET['filter'])){ echo '<h4> Tampil : '. ($_GET['filter'] != 999 ? "Bulan Ke-$_GET[filter]" : "Semua Bulan") . '</h4>'; } else { echo '<h4> Tampil : Semua Bulan </h4>';}?>
            <form action="" method="GET">
              <input type="hidden" name="table" value="<?php echo $table ?>">
              <div class="form-group">
                <select name="filter" class="form-select" aria-label="Default select example">
                  <option disabled selected>Pilih Bulan</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">Nopember</option>
                  <option value="12">Desember</option>
                  <option value="999">ALL</option>
                </select>
                <button type="submit">Filter</button>
                <a href="index.php?table=<?php echo $table ?>"><button type="button" class="button reset">Reset</button></a>
              </div>
            </form>
          <?php endif; ?>
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
                      <th><?= ucwords(preg_replace("(_)", " ", $atribut['COLUMN_NAME'])) ?></th>
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
                  if($table == "bus" && isset($_GET['filter'])){
                    if($_GET['filter'] != "999"){
                      $query .= " WHERE status ='$_GET[filter]'";
                    }
                  } else if($table == "trans_upn" && isset($_GET['filter'])){
                    if($_GET['filter'] != "999"){
                      $query .= " WHERE MONTH(tanggal) ='$_GET[filter]'";
                    }
                  }
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <?php foreach($kolom as $atribut){
                      if($table == "bus"){?>
                        <td><?= $atribut['COLUMN_NAME'] == 'status' ? ($data[$atribut['COLUMN_NAME']] == 1 ? '<span class="badge badge-success">aktif</span>': ($data[$atribut['COLUMN_NAME']] == 2 ? '<span class="badge badge-warning">cadangan</span>' : '<span class="badge badge-danger">rusak</span>')) : $data[$atribut['COLUMN_NAME']] ?> </td>
                      <?php }else { ?>
                        <td><?php echo $data[$atribut['COLUMN_NAME']];  ?></td>
                    <?php }} ?>
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

    <!-- <script src="assets/js/jquery.js"></script> -->
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>

<?php } ?>