<?php
session_start();
require_once('config.php');

$code = $_POST['code'] ? $_POST['code'] : null;


switch($code){
	case 'loadcomments':
		$postid = $_POST['index']? $_POST['index'] : null;
		$sql = "SELECT content,postedDate,username 
				FROM users_comment uc 
				INNER JOIN user u 
				ON uc.userId = u.id 
				WHERE uc.postId = :id
				ORDER BY postedDate";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",intval($postid),PDO::PARAM_INT);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	case 'postcomments':
	
	$content;
	$postid;
	$userid;
	
	if(isset($_POST['comment'])){
		$content = $_POST['comment'];
	}
	if(isset($_POST['postid'])){
		$postid = $_POST['postid'];
	}
	if(isset($_SESSION['userid']))
	{
		$userid = $_SESSION['userid'];
	}
	
	
		if($_SESSION['privilage'] == "empty"||$_SESSION['userid'] == "empty")
		{
			echo json_encode("needlogin");
		}else{
	
		$date = date('Y-m-d h:i:s');
	
		$sql = "INSERT INTO users_comment (content,postedDate,userId,postId)
				VALUES (:content,:date,:userid,:postid)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":content",$content);
		$stmt->bindParam(":date",$date);
		$stmt->bindParam(":userid",intval($userid),PDO::PARAM_INT);
		$stmt->bindParam(":postid",intval($postid),PDO::PARAM_INT);
		$stmt->execute();
		
			if($stmt->rowcount()>0){
				echo json_encode("success");
			}
		}
	break;
	default:
	
}

?>