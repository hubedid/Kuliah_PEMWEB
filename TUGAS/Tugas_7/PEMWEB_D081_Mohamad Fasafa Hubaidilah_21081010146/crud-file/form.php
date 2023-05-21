<?php 

  $status = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if((($_FILES["gambar"]["type"] == "image/gif") || ($_FILES["gambar"]["type"] == "image/jpeg") || ($_FILES["gambar"]["type"] == "image/png") || ($_FILES["gambar"]["type"] == "image/jpg") || ($_FILES["gambar"]["type"] == "image/JPG") || ($_FILES["gambar"]["type"] == "image/pjpeg")) && ($_FILES["gambar"]["size"] < 1024000)) {
      print_r($_FILES["gambar"]["size"] < 1024000);
      if($_FILES["gambar"]["error"] > 0) {
        $status = "Gagal ! Return Code: " . $_FILES["gambar"]["error"];
        header('Location: form.php?status='.$status);
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
        $data = $_POST['kodeBuku'] . "-" . $_POST['judul'] . "-" . $_POST['pengarang'] . "-" . $_POST['penerbit'] . "-" . $_POST['tahunTerbit'] . "-" . $_POST['jumlahHalaman'] . "-" . $_POST['kategori'] . "-" . $_FILES['gambar']['name'] . "\n";
        try{
          file_put_contents('data.txt', $data, FILE_APPEND);
          $status = 'ok';
        }catch(Exception $e){
          $status = $e->getMessage();
        }
        header('Location: form.php?status='.$status);
    }
    } else {
      $status = 'Gagal : Harus gambar yang berukuran tidak lebih dari 10mb';
      header('Location: form.php?status='.$status);
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
                <a class="nav-link" href="<?php echo "index.php"; ?>">Data Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "form.php"; ?>">Tambah Buku</a>
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

          <h2 style="margin: 30px 0 30px 0;">Form Tambah Buku</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kode Buku</label>
              <input type="number" class="form-control" placeholder="Masukkan Kode Buku" name="kodeBuku" required="required">
            </div>
            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" placeholder="Masukkan Judul Buku" name="judul" required="required">
            </div>
            <div class="form-group">
              <label>Pengarang</label>
              <input type="text" class="form-control" placeholder="Masukkan Pengarang" name="pengarang" required="required">
            </div>
            <div class="form-group">
              <label>Penerbit</label>
              <input type="text" class="form-control" placeholder="Masukkan Penerbit" name="penerbit" required="required">
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="number" class="form-control" placeholder="Masukkan Tahun Terbit" name="tahunTerbit" required="required">
            </div>
            <div class="form-group">
              <label>Jumlah Halaman</label>
              <input type="number" class="form-control" placeholder="Masukkan Jumlah Halaman" name="jumlahHalaman" required="required">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" placeholder="Masukkan Kategori" name="kategori" required="required">
            </div>
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" placeholder="gambar" name="gambar" required="required">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          <br><br><br>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>