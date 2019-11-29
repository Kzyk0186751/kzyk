<?php
require_once('config.php');
session_start();

$operation = $_POST['operation']??"no operation";

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = "empty";
}

if(!isset($_SESSION['privilage'])){
    $_SESSION['privilage'] = "empty";
}


switch($operation){
    case 'getmenu':
    $username = $_SESSION['username'] ?? "empty";
    $privillage = $_SESSION['privilage'] ?? "empty";
        
    echo json_encode(array("username"=>$username,"privillage"=>$privillage));        
    
    break;
    default;
    
}

?>