<?php
include_once("connection.php");


function pulluser($conn){
	$allUser=array();
	$sql = "SELECT * FROM user ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $u1=new User($row['ID'],$row['first_name'],$row['last_name'],$row['email'],$row['address']);
		array_push($allUser,$u1);
    }
	return $allUser;
	
} else {
    echo "0 results";
}
}

function pullarticle($conn){
	$allArticle=array();
	$sql = "SELECT * FROM article ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $u1=new User($row['ID'],$row['title'],$row['content'],$row['post_date'],$row['status'],$row['userId'],$row['categoryId']);
		array_push($allArticle,$a1);
    }
	return $allArticle;
	
} else {
    echo "0 results";
}
}



?>