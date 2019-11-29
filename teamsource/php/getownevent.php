<?php
session_start();




require_once('config.php');
$code = $_POST['code'] ?? null;
$id = $_SESSION['userid'] ?? 0;
$privilage = $_SESSION['privilage'] ?? "empty";


if(isset($_SESSION['userid']) && isset($_SESSION['privilage'])){
	switch($code){
			case 'getevents':
			$sql = "SELECT * FROM 
			event WHERE 
			poster_userId = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":id",$id);
			$stmt->execute();
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			header("Content-Type: application/json", true);
			echo json_encode($row);
		break;
		default:
		
	}
}
?>