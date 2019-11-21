<?php

	include("config.php");
	session_start();
	
?>

<!DOCTYPE html>
<html>

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 

</head>

<body>

<?php


	$tableName = "user";
		
	// make a sql statement to check for username and password matching
	$sql = "select id, username, privillage from ".$tableName." where id > '1';";
	
    try {
  	  $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	  $stmt->execute();
	  while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	    
		$id = $row[0];
		$username = $row[1]; 
		$privilage = "";
		switch($row[2])
		{
			case 0: $privilage = "normal";break;
			case 1: $privilage = "blocked";break;
			case 3: $privilage = "event admin";break;
			default: $privilage = "";
		}
		echo"
		<div class='card' style='width:200px'>
		  <img class='card-img-top' src='asset/defaultUser.png' width='50' height='150' alt='image'>
		  <div class='card-body'>
			<h4 class='card-title'>".$username."</h4>
			<p class='card-text'>Status: ".$privilage."</p>
		  </div>
		</div>";

	
		
	  }
	  $stmt = null;
    }
    catch (PDOException $e) {
	  print $e->getMessage();
    }	
	
?>


</body>

