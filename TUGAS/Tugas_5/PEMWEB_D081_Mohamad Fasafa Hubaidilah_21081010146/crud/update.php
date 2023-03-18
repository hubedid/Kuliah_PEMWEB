<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');
  $table = $_GET['table'];
  $status = '';
  $result = '';
  $q = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
  $r = mysqli_query(connection(),$q);
  $atributKolom = mysqli_fetch_array($r);
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET[$atributKolom['COLUMN_NAME']])) {
          //query SQL
          $id = $_GET[$atributKolom['COLUMN_NAME']];
          $query = "SELECT * FROM $table WHERE $atributKolom[COLUMN_NAME] = '$id'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $kueri = array();
      while ($atribut = mysqli_fetch_array($r)) {
        // ${$atribut['COLUMN_NAME']} = $_POST[$atribut['COLUMN_NAME']];
        $kueri[] = $atribut['COLUMN_NAME']."='".$_POST[$atribut['COLUMN_NAME']];
      }
      
      $sql = "UPDATE $table SET "; 
      $sql .= implode("', ",$kueri);
      // $where = $atribut['COLUMN_NAME']."='".$_GET[$atribut['COLUMN_NAME']]."'";
      $sql .= "' WHERE ";
      $sql .= $atributKolom['COLUMN_NAME']."='".$_GET[$atributKolom['COLUMN_NAME']]."'";
      //query SQL
      // echo $sql;
      // $sql = "UPDATE $table SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat' WHERE nrp='$nrp'";

      //eksekusi query
      // $result = mysqli_query(connection(),$sql);
      try{
        $result = mysqli_query(connection(),$sql);
        $status = 'ok';
      }catch(Exception $e){
        $status = $e->getMessage();
      }
      // if ($result) {
      //   $status = 'ok';
      // }
      // else{
      //   $status = 'err';
      // }

      //redirect ke halaman lain
      header('Location: index.php?table='.$table.'&status='.$status);
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
                <a class="nav-link" href="javascript:history.back()">Kembali</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <h2 style="margin: 30px 0 30px 0;">Update <?php echo ucwords($table) ?></h2>
          <form action="" method="POST">
            <?php 
              // $q = "SELECT * FROM customers";
              $q = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
              $r = mysqli_query(connection(),$q);
              // $kolom = [];
              while($data = mysqli_fetch_array($result)){
                while ($atribut = mysqli_fetch_array($r)) {
              //   $kolom[] = $atribut;
              // }
              // foreach($kolom as $atribut){ 
                $qCekFk = "SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_NAME='$atribut[COLUMN_NAME]' AND REFERENCED_TABLE_NAME IS NOT NULL";
                $rCekFk = mysqli_query(connection(),$qCekFk);
                $rowCek = mysqli_fetch_array($rCekFk);
                if($rowCek != NULL){ ?>
                  <div class="form-group">
                    <label><?php echo ucwords(preg_replace("([A-Z])", " $0", $atribut['COLUMN_NAME'])); ?></label>
                    <select class="custom-select" name="<?php echo $atribut['COLUMN_NAME']; ?>" required="required" <?php echo isset($_GET[$atribut['COLUMN_NAME']]) ? "disabled" : "" ?>>
                      <option disabled selected>Pilih Salah Satu</option>
                      <?php 
                        $qDropdown = "SELECT * FROM $rowCek[REFERENCED_TABLE_NAME]";
                        $rDropdown = mysqli_query(connection(),$qDropdown);
                        while ($rowDropdown = mysqli_fetch_array($rDropdown)) {?>
                          <option value="<?php echo $rowDropdown[$rowCek['REFERENCED_COLUMN_NAME']]; ?>" <?php echo $data[$atribut['COLUMN_NAME']]==$rowDropdown[$rowCek['REFERENCED_COLUMN_NAME']] ? "selected" : "" ?> ><?php echo $rowDropdown[$rowCek['REFERENCED_COLUMN_NAME']]; ?></option>
                        <?php } ?>
                    </select>
                  </div>
              <?php } else{ ?>
            <div class="form-group">
              <label><?php echo ucwords(preg_replace("([A-Z])", " $0", $atribut['COLUMN_NAME'])); ?></label>
              <?php if($atribut['DATA_TYPE'] == "text" || $atribut['DATA_TYPE'] == "mediumtext" || $atribut['CHARACTER_MAXIMUM_LENGTH'] >= 1000){ ?>
                <textarea rows="5" class="form-control" name="<?php echo $atribut['COLUMN_NAME']; ?>" <?php echo $atribut['IS_NULLABLE'] == "NO" ? "required" : "" ?> <?php echo isset($_GET[$atribut['COLUMN_NAME']]) ? "readonly" : "" ?>><?php echo $data[$atribut['COLUMN_NAME']];  ?></textarea>
              <?php }else{?>
                <input type="<?php echo $atribut['DATA_TYPE'] == 'decimal' || $atribut['DATA_TYPE'] == 'smallint' || $atribut['DATA_TYPE'] == 'int' ? 'number' : ($atribut['DATA_TYPE'] == 'date' ? 'date' : 'text') ?>" class="form-control" placeholder="<?php echo $atribut['COLUMN_NAME']; ?>" value="<?php echo $data[$atribut['COLUMN_NAME']];  ?>" name="<?php echo $atribut['COLUMN_NAME']; ?>" <?php echo $atribut['IS_NULLABLE'] == "NO" ? "required" : "" ?> <?php echo isset($_GET[$atribut['COLUMN_NAME']]) ? "readonly" : "" ?>>
              <?php } ?>
            </div>
            <?php }}} ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          <br>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
