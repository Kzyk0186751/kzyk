<?php
include_once("connection.php");

$id = $_GET['id'];

$sql ="DELETE FROM article WHERE ID=$id";

if(mysqli_query($connect,$sql))

header("refresh:1;url=showarticle.php");

else 

echo "Not deleted";





?>