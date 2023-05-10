<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include('conn.php'); 
  $table = $_GET['table'];
  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
    $r = $conn->query($q);
    $kueri = array();
    while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
      // ${$row['COLUMN_NAME']} = $_POST[$row['COLUMN_NAME']];
      $kueri[] = $_POST[$row['COLUMN_NAME']];
    }
    
    $query = "INSERT INTO $table VALUES('"; 
    $query .= implode("','",$kueri);
    $query .= "')";

    try{
      $result = $conn->query($query);
      $status = 'ok';
    }catch(Exception $e){
      $status = $e->getMessage();
    }
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
              <?php 
                $qTable = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA='$dbName'";
                $rTable = $conn->query($qTable);
                while ($rowTable = $rTable->fetch(PDO::FETCH_ASSOC)) {
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
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form <?php echo ucwords($table) ?></h2>
          <form action="" method="POST">
            <?php 
              $q = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
              $r = $conn->query($q);
              $kolom = [];
              while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
                $qCekFk = "SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_NAME='$row[COLUMN_NAME]' AND REFERENCED_TABLE_NAME IS NOT NULL";
                $rCekFk = $conn->query($qCekFk);
                $rowCek = $rCekFk->fetch(PDO::FETCH_ASSOC);
                if($rowCek != NULL){ ?>
                  <div class="form-group">
                    <label><?php echo ucwords(preg_replace("([A-Z])", " $0", $row['COLUMN_NAME'])); ?></label>
                    <select class="custom-select" name="<?php echo $row['COLUMN_NAME']; ?>" required="required">
                      <option disabled selected>Pilih Salah Satu</option>
                      <?php 
                        $qDropdown = "SELECT * FROM $rowCek[REFERENCED_TABLE_NAME]";
                        $rDropdown = $conn->query($qDropdown);
                        while ($rowDropdown = $rDropdown->fetch(PDO::FETCH_ASSOC)) {?>
                          <option value="<?php echo $rowDropdown[$rowCek['REFERENCED_COLUMN_NAME']]; ?>"><?php echo $rowDropdown[$rowCek['REFERENCED_COLUMN_NAME']]; ?></option>
                        <?php } ?>
                    </select>
                  </div>
              <?php } else{ ?>
            <div class="form-group">
            <label><?php echo ucwords(preg_replace("([A-Z])", " $0", $row['COLUMN_NAME'])); ?></label>
            <?php if($row['DATA_TYPE'] == "text" || $row['DATA_TYPE'] == "mediumtext"){ ?>
                <textarea class="form-control" name="<?php echo $row['COLUMN_NAME']; ?>" <?php echo $row['IS_NULLABLE'] == "NO" ? "required" : "" ?> placeholder="<?php echo $row['COLUMN_NAME'];  ?>"></textarea>
              <?php }else{?>
                <input type="<?php echo $row['DATA_TYPE'] == 'decimal' || $row['DATA_TYPE'] == 'smallint' || $row['DATA_TYPE'] == 'int' ? 'number' : ($row['DATA_TYPE'] == 'date' ? 'date' : 'text') ?>" class="form-control" placeholder="<?php echo ucwords(preg_replace("([A-Z])", " $0", $row['COLUMN_NAME'])); ?>" name="<?php echo $row['COLUMN_NAME']; ?>" <?php echo $row['IS_NULLABLE'] == "NO" ? "required" : "" ?> <?php echo isset($_GET[$row['COLUMN_NAME']]) ? "readonly" : "" ?>>
              <?php } ?>
            </div>
            <?php }} ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>