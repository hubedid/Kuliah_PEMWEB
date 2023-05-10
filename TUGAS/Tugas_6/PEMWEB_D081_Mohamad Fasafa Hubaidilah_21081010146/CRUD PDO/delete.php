<?php 

  include ('conn.php'); 
  $table = $_GET['table'];
  $status = '';
  $result = '';
  $q = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
  $r = $conn->query($q);
  $atributKolom = $r->fetch(PDO::FETCH_ASSOC);
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET[$atributKolom['COLUMN_NAME']])) {
          //query SQL
          $id = $_GET[$atributKolom['COLUMN_NAME']];
          $query = $conn->prepare("DELETE FROM $table WHERE $atributKolom[COLUMN_NAME] = :id");
          $query->bindParam(':id',$id);

          //eksekusi query
          try{
            $query->execute();
            $status = 'ok';
          }catch(Exception $e){
            $status = $e->getMessage();
          }

          //redirect ke halaman lain
        header('Location: index.php?table='.$table.'&status='.$status);
      // header('Location: index.php?status='.$status);
      }  
  }