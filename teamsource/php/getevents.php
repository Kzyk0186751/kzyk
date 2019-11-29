<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;

switch($code){
		case 'getevents':
		$sql = "SELECT * FROM 
		event WHERE 
		eventDate = CURDATE()
		AND eventStatus = 0
		ORDER BY postedDate";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	default:
	
}

?>