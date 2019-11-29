<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;

switch($code){
	case 'loadarticles':
		$sql = "SELECT postId,post_title,post_content,post_date,username
				FROM  posts p NATURAL JOIN user u
				WHERE p.userId = u.id
				ORDER BY post_date";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	default:
	
}

?>