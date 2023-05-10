<?php 
$dbName = "classicmodels";
function connection($dbName = "classicmodels") {
   // membuat konekesi ke database system
   $dbServer = 'localhost';
   $dbPort = 3305;
   $dbUser = 'root';
   $dbPass = '';
   
   $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName, $dbPort);

   if(! $conn) {
	die('Koneksi gagal: ' . mysqli_error());
   }
   //memilih database yang akan dipakai
   // mysqli_select_db($conn,$dbName);
	
   return $conn;
}
