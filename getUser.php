<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('phpfunc.php');
include_once("connection.php");
$all=pulluser($connect);

$userArray=[];
foreach($all as $user)
    $userArray[]=$user->getAsArray();

if(isset($_POST["userrequest"])){
http_response_code(200);
echo json_encode($userArray);
}

