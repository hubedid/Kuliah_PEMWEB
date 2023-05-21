<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if(isset($_GET['datos'])) {
        $filetemp = file('data.txt');
        foreach($filetemp as $datos){
          if ($datos == $_GET['datos']."\n") {
            $data = explode("-", $datos);
            break;
          }
        }
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['datos'])) {
        $filetemp = file('data.txt');
        foreach($filetemp as $datos){
          if ($datos == $_POST['datos']."\n") {
            $data = explode("-", $datos);
            if(isset($_FILES["gambar"]) && !empty($_FILES["gambar"]["name"])){
              unlink("upload/" . str_replace(array("\r", "\n", "\r\n"), '', $data['7']));
              if((($_FILES["gambar"]["type"] == "image/gif") || ($_FILES["gambar"]["type"] == "image/jpeg") || ($_FILES["gambar"]["type"] == "image/png") || ($_FILES["gambar"]["type"] == "image/jpg") || ($_FILES["gambar"]["type"] == "image/JPG") || ($_FILES["gambar"]["type"] == "image/pjpeg")) && ($_FILES["gambar"]["size"] < 10240000)) {
                if($_FILES["gambar"]["error"] > 0) {
                  $status = "Gagal ! Return Code: " . $_FILES["gambar"]["error"];
                  header('Location: index.php?status='.$status);
                }else {
                  if(file_exists("upload/" . $_FILES["gambar"]["name"])) {
                    unlink("upload/" . $_FILES["gambar"]["name"]);
                    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/" . $_FILES["gambar"]["name"]);
                    $location = "upload/" . $_FILES["gambar"]["name"];
                  }
                  else {
                    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/" . $_FILES["gambar"]["name"]);
                    $location = "upload/" . $_FILES["gambar"]["name"];
                  }
                  $dataUpdate = $_POST['kodeBuku'] . "-" . $_POST['judul'] . "-" . $_POST['pengarang'] . "-" . $_POST['penerbit'] . "-" . $_POST['tahunTerbit'] . "-" . $_POST['jumlahHalaman'] . "-" . $_POST['kategori'] . "-" . $_FILES['gambar']['name'] . "\n";
                }
              } else {
                $status = 'Gagal : Harus gambar yang berukuran tidak lebih dari 10mb';
                header('Location: index.php?status='.$status);
              }
            }else{
              $dataUpdate = $_POST['kodeBuku'] . "-" . $_POST['judul'] . "-" . $_POST['pengarang'] . "-" . $_POST['penerbit'] . "-" . $_POST['tahunTerbit'] . "-" . $_POST['jumlahHalaman'] . "-" . $_POST['kategori'] . "-" . $data['7'];
            }
            echo $dataUpdate;
            $edit = file_get_contents('data.txt');
            $edit = str_replace($_POST['datos']."\n", $dataUpdate, $edit);
            try{
              file_put_contents('data.txt', $edit);
              $status = 'ok';
            }catch(Exception $e){
              $status = $e->getMessage();
            }
          }
        }
      }
      header('Location: index.php?status='.$status);
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
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Buku berhasil disimpan</div>';
              }
              else{
                echo '<br><br><div class="alert alert-danger" role="alert">'.$status.'</div>';
              }
            }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Update Data Buku</h2>
          <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label>Kode Buku</label>
              <input type="number" class="form-control" value="<?= $data['0'] ?>" name="kodeBuku" required="required">
            </div>
            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" value="<?= $data['1'] ?>" name="judul" required="required">
            </div>
            <div class="form-group">
              <label>Pengarang</label>
              <input type="text" class="form-control" value="<?= $data['2'] ?>" name="pengarang" required="required">
            </div>
            <div class="form-group">
              <label>Penerbit</label>
              <input type="text" class="form-control" value="<?= $data['3'] ?>" name="penerbit" required="required">
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="number" class="form-control" value="<?= $data['4'] ?>" name="tahunTerbit" required="required">
            </div>
            <div class="form-group">
              <label>Jumlah Halaman</label>
              <input type="number" class="form-control" value="<?= $data['5'] ?>" name="jumlahHalaman" required="required">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" value="<?= $data['6'] ?>" name="kategori" required="required">
            </div>
            <div class="form-group">
              <label>Gambar</label>
              <img src="upload/<?php echo $data['7'] ?>" height="200px" alt="">
              <input type="file" class="form-control" value="gambar" name="gambar">
            </div>
            <input type="hidden" name="datos" value="<?= $_GET['datos'] ?>">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
