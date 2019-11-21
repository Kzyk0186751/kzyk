<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('phpfunc.php');
include_once("connection.php");
$allArticle=pullarticle($connect);

$articleArray=[];
foreach($allArticle as $article)
    $articleArray[]=$article->getAsArray();

if(isset($_POST["articlerequest"])){
http_response_code(200);
echo json_encode($articleArray);
}

