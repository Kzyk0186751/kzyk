<?php   
 //logout.php  
 session_start();  
 session_unset();
 session_destroy();
 //echo $_SESSION['username'];
 header("location:index.html");  
 ?> 