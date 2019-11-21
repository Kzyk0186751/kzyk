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

</html>




<?php

	include("config.php");
	//session_start();
	
	if(isset($_GET['approveUpdate']))
	{
		approveUpdate($_GET['approveUpdate']);
	}
	
	if(isset($_GET['rejectUpdate']))
	{
		rejectUpdate($_GET['rejectUpdate']);
	}
	
	$tableName = "article";
		
	// make a sql statement to check for username and password matching
	$sql = "select id, title, content from ".$tableName." where status = '0';";
	
	//status 0 = pending
	//status 1 = approve
	//status 2 = reject
	
    try {
  	  $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	  $stmt->execute();
	  while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	    //$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
	    //print $data;
		$id = $row[0];
		$subject = $row[1]; 
		$content = $row[2]; 
		
		//echo "<div id >";
		echo "<h1>" .$subject. "</h1>
			  <h4>" .$content. "</h4>
			  <a class = 'btn' style = 'background : green' href = 'previewArticle.php?approveUpdate=".$id."' name = 'approve'> Approve </a>
			  <a class = 'btn' style = 'background : red' href = 'previewArticle.php?rejectUpdate=".$id."' name = 'reject'> Reject </a>
			  ";
	
		//echo "</div>"
	  }
	  $stmt = null;
    }
    catch (PDOException $e) {
	  print $e->getMessage();
    }	
	
	
	
function approveUpdate($id)
{
	include("config.php");
	$tableName = "article";

	$updateSQL = "UPDATE ".$tableName." SET status = '1' WHERE id = '".$id."';";
	try{
	$update = $pdo->prepare($updateSQL);
	$update->execute();
	}
	catch(PDOException $e) {
	  print $e->getMessage();
    }	
	
	alertMsg("Approved");
	
	//header("location:previewArticle.php");	
}

function rejectUpdate($id)
{
	//echo $id;
	include("config.php");
	$tableName = "article";

	$updateSQL = "UPDATE ".$tableName." SET status = '2' WHERE id = '".$id."';";
	try{
	$update = $pdo->prepare($updateSQL);
	$update->execute();
	}
	catch(PDOException $e) {
	  print $e->getMessage();
    }	
	
	alertMsg("Reject");
	
	//header("location:previewArticle.php");	
}

function alertMsg($message)
{
	echo "<script>
	alert('$message');
	</script>";
}

?>