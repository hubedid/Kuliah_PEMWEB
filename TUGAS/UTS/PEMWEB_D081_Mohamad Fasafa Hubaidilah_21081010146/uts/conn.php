<?php 
// versi online : https://pemweb.hoaks.my.id/uts/index.php?table=bus
$dbName = "transupn";
function connection($dbName = "transupn") {
   // Menggunakan Database Local
   // $dbServer = 'localhost';
   // $dbPort = 3306;
   // $dbUser = 'root';
   // $dbPass = '';

   // Menggunakan Database Server
   // Kelemahannya Lemot 
   $dbServer = 'api2.hoaks.my.id';
   $dbPort = 3306;
   $dbUser = 'pemweb';
   $dbPass = 'Longsor.berapi1';
   
   $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName, $dbPort);

   if(! $conn) {
	die('Koneksi gagal: ' . mysqli_error());
   }
   //memilih database yang akan dipakai
   // mysqli_select_db($conn,$dbName);
	
   return $conn;
}
