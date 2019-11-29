<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;

switch($code){
	case 'getevents':
		$sql = "SELECT * FROM 
		event WHERE 
		eventDate < NOW()  + INTERVAL 30 DAY 
		AND eventDate > CURDATE()
		ORDER BY postedDate";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	case 'del_event':
	
		$delid = $_POST['delid'] ?? 0;
	
		$sql = "DELETE FROM event
				WHERE eventId = :delid";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":delid",$delid,PDO::PARAM_INT);
		$stmt->execute();
		
		if($stmt->rowcount()>0)
		{
			echo json_encode("success");
		}
	break;
	default:
	
}