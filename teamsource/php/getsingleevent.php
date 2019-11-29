<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;
$index = $_POST['index'] ? $_POST['index'] : null;

switch($code){
	case 'loadevent':
		$sql = "SELECT eventName,eventDescription,postedDate,username
				FROM  event e INNER JOIN user u
				WHERE e.poster_userId = u.id
				AND e.eventId = :id";
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