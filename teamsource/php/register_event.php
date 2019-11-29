<?php

session_start();
require_once('config.php');

$privilage = $_SESSION['privilage'] ?? "empty";
$userid = $_SESSION['userid'] ?? "empty";

if(isset($_POST['reqest'])&&$privilage==3){
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$date = $_POST['date'];
	$posted_date = date('Y-m-d h:i:s');
	
	$sql = "SELECT * FROM event ORDER BY eventId DESC LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$count = $row['eventId'];
	$count = (int)$count + 1;
	
	if($_FILES["file"]["name"] != ''){
		$test = explode(".",$_FILES["file"]["name"]);
		$extension = end($test);
		$name = '00'.$count.'.'.$extension;
		$location = '../img/'.$name;
		move_uploaded_file($_FILES["file"]["tmp_name"],$location);
	}

	$sql = "INSERT INTO event (eventName,eventDescription,postedDate,eventDate,eventImage,poster_userId)
			VALUES(:eventName,:eventDescription,:postedDate,:eventDate,:eventImage,:poster_userId)";
		$stmt2 = $pdo->prepare($sql);
		$stmt2->bindParam(":eventName",$title);
		$stmt2->bindParam(":eventDescription",$content);
		$stmt2->bindParam(":postedDate",$posted_date);
		$stmt2->bindParam(":eventDate",$date);
		$stmt2->bindParam(":eventImage",$name);
		$stmt2->bindParam(":poster_userId",$userid);
		$stmt2->execute();

		if($stmt->rowcount()>0){
			echo "success";
		}

}else{
	echo "nosuccess";
}

?>