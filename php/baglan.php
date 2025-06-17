<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$DB_host = "";
$DB_user = "";
$DB_pass = "";
$DB_name = "";
 try
 {
     $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $DBcon->exec("SET CHARACTER SET utf8");
	 $DBcon->query("SET NAMES 'utf8'");
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }
 ?>