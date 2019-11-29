<?php
session_start();
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;

switch($code){
	case 'reg_event':
	
		$evtid = $_POST['evtid'] ?? 0;
		$userid = $_SESSION['userid'] ?? 0;
		
		$sql = "SELECT * FROM event_participant
				WHERE eventId = :evtId AND userId = :userId";
		$stmt2 = $pdo->prepare($sql);
		$stmt2->bindParam(":evtId",$evtid,PDO::PARAM_INT);
		$stmt2->bindParam(":userId",$userid,PDO::PARAM_INT);
		$stmt2->execute();
	
			$sql = "INSERT INTO event_participant (eventId,userId)
					VALUES (:evtId,:userId)
					ON DUPLICATE KEY UPDATE eventId = :evtId, userId = :userId";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":evtId",$evtid,PDO::PARAM_INT);
			$stmt->bindParam(":userId",$userid,PDO::PARAM_INT);
			$stmt->execute();
			
			if($stmt->rowcount()>0)
			{
				echo json_encode("success");
			}
			else
			{
				echo json_encode("fail");
			}
			
		
		
	break;
	default:
	
}