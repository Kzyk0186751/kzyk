<?php
   define('DB_SERVER', 'localhost');
   //define('DB_USERNAME', 'id11220730_admin');
   //define('DB_PASSWORD', 'admin');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'id11220730_newsletter');
   // $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $hostInfo = "mysql:host=".DB_SERVER."; dbname=".DB_DATABASE;
   $pdo = new PDO($hostInfo, DB_USERNAME, DB_PASSWORD);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>