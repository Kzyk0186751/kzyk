<?php
	
	session_start();
	
?>

<!DOCTYPE html>
<html>

<head>
	<title>User Panel</title>
	
	
	
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 

	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel = "stylesheet" href = "style.css">
	
</head>

<body>
	<nav class="navbar navbar-fixed-top navbar-custom">

	  <div class="container-fluid">

		<div class="navbar-header">

		  <a class="navbar-brand" href="index.php"> 
		  
		  <img src = "asset\kdupg_logo.png" style="width:42px;height:42px;border:0;">
		  
		  </a>

		</div>

		<ul class="nav navbar-nav">

		  <li class="active"><a class="nav-text" href="index.php">Home</a></li>
		  <li><a class="nav-text" href="#">Page 1</a></li>
		  <li><a class="nav-text" href="#">Page 2</a></li>
		  <li><a class="nav-text" href="#">Page 3</a></li>

		</ul>
		
		<ul class="nav navbar-nav navbar-right">
		  
		  <li>
				
				<?php 
					if(!isset($_SESSION['username']))
					{
						echo "<a class='nav-text' href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a>";
						
					}
					else
					{
						echo "<a class='nav-text' href='#' name = 'status'>";
						echo $_SESSION['username'];
					}
				?>
				</a>
			</li>
			<?php
			if(isset($_SESSION['username']))
			{
				echo "<li>";
				echo "	<a class='nav-text' href='logout.php'> Logout</a>";
				echo "</li>";
			}
			?>
		  
		  
		  
		  <li></li>
		</ul>

	  </div>

	</nav> 
	
	<div class="col-sm-3 px-1 bg-dark">
        <div class="py-2 sticky-top flex-grow-1">
            <div class="nav flex-sm-column">
                <a href="" class="nav-link d-none d-sm-inline">Sidebar</a>
                <a href="" class="nav-link">Link</a>
                <a href="" class="nav-link">Link</a>
                <a href="" class="nav-link">Link</a>
                <a href="" class="nav-link">Link</a>
                <a href="" class="nav-link">Link</a>
            </div>
        </div>
    </div>
	

</body>

</html>

<!--    		

<li><a class="nav-text" href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
<li><a class="nav-text" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

>