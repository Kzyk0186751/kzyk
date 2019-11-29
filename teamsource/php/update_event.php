<?php

session_start();
require_once('config.php');

$privilage = $_SESSION['privilage'] ?? "empty";
$userid = $_SESSION['userid'] ?? "empty";

if(isset($_POST['reqest'])&&$privilage==3){
	
	$id = $_POST['index'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$date = $_POST['date'];
	
	$sql = "SELECT eventImage FROM event where eventId = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$imagename = $row['eventImage'];

if(isset($_FILES["file"])){

	if($_FILES["file"]["name"] != ''){
		$test = explode(".",$_FILES["file"]["name"]);
		$extension = end($test);
		$name = $imagename;
		$location = '../img/'.$name;
		move_uploaded_file($_FILES["file"]["tmp_name"],$location);
	}
}

	$sql = "UPDATE event SET 
			eventName = :eventName,
			eventDescription = :eventDescription,
			eventDate = :eventDate
			where eventId = :id";
		$stmt2 = $pdo->prepare($sql);
		$stmt2->bindParam(":eventName",$title);
		$stmt2->bindParam(":eventDescription",$content);
		$stmt2->bindParam(":eventDate",$date);
		$stmt2->bindParam(":id",$id);
		$stmt2->execute();

		if($stmt->rowcount()>0){
			echo "success";
		}

}else{
	echo "nosuccess";
}

?>