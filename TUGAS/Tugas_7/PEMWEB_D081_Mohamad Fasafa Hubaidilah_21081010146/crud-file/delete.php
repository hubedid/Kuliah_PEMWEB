<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['datos'])) {
          $filetemp = file('data.txt');
          foreach($filetemp as $datos){
            if ($datos == $_GET['datos']."\n") {
                $data = explode("-", $datos);
                // echo $data['7'];
                unlink("upload/" . str_replace(array("\r", "\n", "\r\n"), '', $data['7']));
                $edit = file_get_contents('data.txt');
                $edit = str_replace($_GET['datos']."\n", "", $edit);
                try{
                  file_put_contents('data.txt', $edit);
                  $status = 'ok';
                }catch(Exception $e){
                  $status = $e->getMessage();
                }
                // header('Location: index.php?status='.$status);
              }
          }
      }  
  }