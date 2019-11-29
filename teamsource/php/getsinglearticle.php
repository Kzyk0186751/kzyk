<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;
$index = $_POST['index'] ? $_POST['index'] : null;

switch($code){
	case 'loadarticle':
		$sql = "SELECT title,content,post_date,username
				FROM  article a INNER JOIN user u
				WHERE a.userId = u.id
				AND a.id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$index);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	default:
	
}

?>