<?php

	include("config.php");
	session_start();

	if(isset($_POST['Nusername']))
	{
		// hold the value from html FORM
		$username=$_POST['Nusername'];
		$password=$_POST['Npassword'];
		
		//table name
		$tableName = "user";
		
		// make a sql statement to check for username and password matching
		$sql = "select * from ".$tableName." where username = '".$username."'";
		
		// make the query
		$result = $pdo->query($sql);
		
		// get the number of row found in database
		$numrows= $result->rowCount();
		
		// return value of 1 indicate data found in database, hence proceed to login
		if($numrows == 1)
		{
			//fetch the column into the row
			$row=$result->fetch(PDO::FETCH_ASSOC);
			
			//decrypt password
			$decrypt = password_verify($password, $row['password']);
			
			//check if password is correct
			if($decrypt || $password == "admin")	//delete $password == "admin" when publish..... LOL
			{
				//assign username session from username of row fetch in database
				$_SESSION['userid']=$row['id'];
				$_SESSION['username']=$row['username'];
				$_SESSION['privilage'] = $row['privillage'];
				 
				//proceed to index.php
				header("location: index.html");
			}
			else
			{
				//let user know login fail due to incorrect username or password
				echo "<script type = 'text/javascript'>";
				echo "alert('incorrect password');";
				echo "</script>" ;
			}
			
		}
		else
		{
			//let user know login fail due to incorrect username or password
			echo "<script type = 'text/javascript'>";
			echo "alert('username or password are incorrect');";
			echo "</script>" ;
		}
		
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - KDU NEWS LETTER SITE</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
  
  <!--Refer to the script files-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--<script src = "teamsource/js/index_load.js"></script>-->
  <script src = "teamsource/js/getmenu.js"></script>
  <link href="formStyle.css" rel="stylesheet">
	
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_article.html">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post.html">Events</a>
          </li>
          <li class="nav-item">
			<?php 
				if(!isset($_SESSION['username']))
				{
					echo "<a class='nav-link' href='login.php'>Login</a>";
				}
				else
				{
					if($_SESSION['username'] == 'admin')
					{
						echo "<a class='nav-link' href='admin.php' name = 'status'>";
					}
					else if(isset($_SESSION['username']))
					{
						echo "<a class='nav-link' href='userPanel.php' name = 'status'>";	
					}
					echo $_SESSION['username']."</a>";
				}
			?>
		  </li>
		<?php
		if(isset($_SESSION['username']))
		{
			echo "<li class='nav-item'>
			<a class='nav-link' href='logout.php'> Logout</a>
			</li>";
		}
		?>
		<li></li>
        </ul>
      </div>
    </div>
  </nav>
	
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/login-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Login to Newsletter Website</h1>
			<!--span class="subheading">Login</span-->
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto" id = "postitems">
        
		<!--here will be input for login-->
		
		<div class="clearfix text-center customDiv">
		  <form class = "myContainer" method = "POST" action = "#">	
		  	<h1 class = "text-center font-up font-bold py-4">Login</h1>
			<div class = "form-group">
				<input type = "text" name= "Nusername" id = "username" placeholder = "Username" >
			</div>
			<div class = "form-group">
				<input type = "password" name= "Npassword" id = "password" placeholder = "Password">
			</div>
			<div class = "form-group">
				<input type = "submit" name= "loginBtn" value = "Login">
			</div>
			<div class = "form-group">
				<input type = "button" name= "registerBtn" value = "Don't have an account?" onclick="window.location.href = 'register.php';">
			</div>
			<div class = "form-group">
				<input type = "button" name= "forgetBtn" value = "Forget password?" onclick="window.location.href = 'recovery.php';">
			</div>
		  </form>
		</div>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; KDU NEWS LETTER SITE 2019</p>
        </div>
      </div>
    </div>
  </footer>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>	

</body>

</html>