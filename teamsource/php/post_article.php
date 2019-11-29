<?php
session_start();
require_once('config.php');

$title = $_POST['title'];
$content = $_POST['content'];
//$categoryId = $_POST['categoryId'];
$date = date('Y-m-d h:i:s');
$privilage = 3;
$status = "disable";
$posterId = 1;
$categoryId = 1;

switch($privilage){
	case 3:
		$sql = "INSERT INTO article (title,content,post_date,status,userId,categoryId)
				VALUES(:title,:content,:postdate,:status,:posterId,:categoryId)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":title",$title);
		$stmt->bindParam(":content",$content);
		$stmt->bindParam(":postdate",$date);
		$stmt->bindParam(":status",$status);
		$stmt->bindParam(":posterId",$posterId);
		$stmt->bindParam(":categoryId",$categoryId);
		$stmt->execute();

		if($stmt->rowcount()>0){
			echo "success";
		}
	break;
	default:
	
}

?>