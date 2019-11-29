<?php
session_start();
require_once('config.php');

$code = $_POST['code'] ?? null;

if(isset($code)){
	
	if(isset($_SESSION['privilage'])){
		$privilage = $_SESSION['privilage'];		
		echo json_encode($privilage);
	}else{
		echo json_encode("failed");
	}
	
}

?>