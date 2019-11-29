<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;

switch($code){
	case 'getevents':
		$sql = "SELECT * FROM 
		event WHERE 
		eventDate < NOW()  + INTERVAL 30 DAY 
		AND eventDate > CURDATE()
		AND eventStatus = 1
		ORDER BY postedDate";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	case 'valid_event':
	
		$evtid = $_POST['evtid'] ?? 0;
	
		$sql = "UPDATE event
				SET eventStatus = 0
				WHERE eventId = :evtid";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":evtid",$evtid,PDO::PARAM_INT);
		$stmt->execute();
		
		if($stmt->rowcount()>0)
		{
			echo json_encode("success");
		}
	break;
	default:
	
}