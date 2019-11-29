<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;
$postid = $_POST['postid'] ?? null;

switch($code){
	case 'loadcomments':
		$sql = "SELECT content,username
				FROM  users_comment c NATURAL JOIN user u
				WHERE c.userId = u.id
				AND postId = :postid
				ORDER BY postId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":postid",intval($postid),PDO::PARAM_INT);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	default:
	
}

?>