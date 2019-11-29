<?php
require_once('config.php');

session_start();
$uid = $_SESSION['userid'] ?? null;
$code = $_POST['code'] ? $_POST['code'] : null;

if(isset($_SESSION['userid'])){
	switch($code){
		case 'getprofile':
			$sql = "SELECT * FROM  users_profile where userId = :uid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":uid",$uid);
			$stmt->execute();
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($row);
		break;
		case 'updateprofile':
		$dept = $_POST['department'];
		$age = $_POST['age'];
		$ptext = $_POST['profile'];
		
			
		
			$sql = "INSERT INTO users_profile (department,age, profile_text,userId)
					VALUES (:dept,:age,:ptext,:id)
					ON DUPLICATE KEY UPDATE
					department = :dept, age = :age, profile_text = :ptext, userId = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':dept',$dept);
			$stmt->bindParam(':age',$age);
			$stmt->bindParam(':ptext',$ptext);
			$stmt->bindParam(':id',$uid);
			$stmt->execute();
			
			if($stmt->rowcount()>0){
				echo "success";
			}else{
				echo "fail";
			}
			
		break;
		default:
		
	}
}

?>