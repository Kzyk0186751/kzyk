<?php
session_start();
$connect = new mysqli('localhost','root', '', 'id11220730_newsletter');


// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>