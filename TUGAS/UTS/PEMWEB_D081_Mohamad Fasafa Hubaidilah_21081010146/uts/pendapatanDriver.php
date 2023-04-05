<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
//   include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UTS</title>
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
          <h2 style="margin: 30px 0 30px 0;">Pendapatan Driver</h2>
          <?php if(isset($_GET['filter'])){ echo '<h4> Tampil : '. ($_GET['filter'] != 999 ? "Bulan Ke-$_GET[filter]" : "Semua Bulan") . '</h4>'; } else { echo '<h4> Tampil : Semua Bulan </h4>';} ?>
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
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                    <th>Id Driver</th>
                    <th>Nama Driver</th>
                    <th>Total KM</th>
                    <th>Gaji per KM</th>
                    <th>Total Gaji</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM driver ORDER BY id_driver ASC";
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                    <?php
                    if(isset($_GET['filter'])){
                        $queryKmDriver = "SELECT SUM(jumlah_km) AS total_km FROM trans_upn WHERE id_driver = $data[id_driver] AND MONTH(tanggal) = '$_GET[filter]' GROUP BY id_driver";
                    }else{
                        $queryKmDriver = "SELECT SUM(jumlah_km) AS total_km FROM trans_upn WHERE id_driver = $data[id_driver] GROUP BY id_driver";
                    }
                        $result_km = mysqli_query(connection(),$queryKmDriver);
                        $data_km_driver = mysqli_fetch_assoc($result_km);

                    if($data_km_driver != NULL){
                        $total_km = $data_km_driver['total_km'];
                        $kmGaji = 3000;
                        $gaji_driver = $total_km * $kmGaji;
                    ?>
                    <tr>
                        <td><?php echo $data['id_driver'];  ?></td>
                        <td><?php echo $data['nama'];  ?></td>
                        <td><?php echo $total_km ?></td>
                        <td><?php echo $kmGaji;  ?></td>
                        <td><?php echo $gaji_driver;  ?></td>
                    </tr>
                    <?php } ?>
                  
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

