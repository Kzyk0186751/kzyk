<?php
require_once('config.php');
$code = $_POST['code'] ? $_POST['code'] : null;
$offset = 0;
switch($code){
	case 'loadarticles':
		$sql = "SELECT a.id,a.title,a.content,a.post_date,u.username,c.category
				FROM article a 
				INNER JOIN user u
				ON a.userId = u.id
				INNER JOIN category c
				ON a.categoryId = c.categoryId
				WHERE status = 1 
				ORDER BY post_date
				LIMIT 100 OFFSET :offset";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":offset",intval($offset),PDO::PARAM_INT);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	
	case 'searcharticles':
	
		$category = $_POST['searchcateg'] ?? 'title';
		$parameter = $_POST['searchval'] ?? 0;
	
		$sql = "SELECT a.id,a.title,a.content,a.post_date,u.username,c.category
				FROM article a 
				INNER JOIN user u
				ON a.userId = u.id
				INNER JOIN category c
				ON a.categoryId = c.categoryId
				WHERE status = 1
				AND $category = :param
				ORDER BY post_date
				LIMIT 100 OFFSET :offset";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":offset",intval($offset),PDO::PARAM_INT);
		if($category == 'title'){
			$category = 'a.'.$category;
			$stmt->bindParam(":param",$parameter,PDO::PARAM_STR);
		}
		if($category == 'category'){
			$category = 'c.'.$category;
			$stmt->bindParam(":param",$parameter,PDO::PARAM_STR);
		}
		if($category == 'username'){
			$category = 'u.'.$category;
			$stmt->bindParam(":param",$parameter,PDO::PARAM_STR);
		}
		$stmt->execute();

		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo json_encode($row);
	break;
	default:
	
}

?>