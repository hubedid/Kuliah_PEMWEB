<?php 

  include ('conn.php'); 
  $table = $_GET['table'];
  $status = '';
  $result = '';
  $q = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = '$table'";
  $r = mysqli_query(connection(),$q);
  $atributKolom = mysqli_fetch_array($r);
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET[$atributKolom['COLUMN_NAME']])) {
          //query SQL
          $id = $_GET[$atributKolom['COLUMN_NAME']];
          $query = "DELETE FROM $table WHERE $atributKolom[COLUMN_NAME] = '$id'"; 

          //eksekusi query
          try{
            $result = mysqli_query(connection(),$query);
            $status = 'ok';
          }catch(Exception $e){
            $status = $e->getMessage();
          }
          // $result = mysqli_query(connection(),$query);

          // if ($result) {
          //   $status = 'ok';
          // }
          // else{
          //   $status = 'err';
          // }

          //redirect ke halaman lain
        header('Location: index.php?table='.$table.'&status='.$status);
      // header('Location: index.php?status='.$status);
      }  
  }