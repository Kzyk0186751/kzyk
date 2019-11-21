<?php

	include("config.php");
	
	if(isset($_POST['Nusername']))
	{
		// hold the value from html FORM
		$username = $_POST['Nusername'];
		$password = $_POST['Npassword'];
		$confirm  = $_POST['Nconfirm'];
		$email	  = $_POST['Nemail'];
		$privillage = "0";
		
		//privillage 0 = default
		//privillage 1 = blocked
		//privillage 2 = able to create event
		//privillage 4 = admin
		
		
		//table name
		$tableName = 'user';
		
		//encrypt password
		$encrypt = password_hash($password, PASSWORD_BCRYPT);
		
		// make a sql statement to check respective data
		$usernameSQL = "select username from ".$tableName." where username = '".$username."'";
		$emailSQL = "select email from ".$tableName." where email = '".$email."'";
		
		// make a sql statement to insert user's data
		$registerSQL = "insert into ".$tableName." (username, password, email, privillage) values (?,?,?,?);";
		
		
		// make the query
		$checkUsername = $pdo->query($usernameSQL);
		$checkEmail = $pdo->query($emailSQL);
		
		//prepare register statement
		$prepareRegister = $pdo->prepare($registerSQL);
		
		// get the number of row found in database
		$usernameRow = $checkUsername->rowCount();
		$emailRow = $checkEmail->rowCount();
		
		if($usernameRow > 0)
		{
			echo "<script>alert('username had been taken');</script>";
		}
		else if($emailRow > 0)
		{
			echo "<script>alert('email address had been taken');</script>";
		}
		else
		{
			// execute the sql statement
			$prepareRegister->execute([$username, $encrypt, $email, $privillage]);
			
			echo "<script>alert('register successfully');</script>";
			
			//proceed to login.php to login
			header("location: login.php");
		}
		
		
		
	}
	
?>

<script src = "js/register.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register - KDU NEWS LETTER SITE</title>

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
            <h1>Register to Newsletter Website</h1>
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
		    <h1 class = "text-center font-up font-bold py-4">Register</h1>
		    <div class = "form-group">
		    <input type = "text" name = "Nusername" id = "username" placeholder = "Username" pattern = "[a-zA-Z0-9]{6,}" required onkeyup = 'checkUsername();'>
		    </div>
		    <div class = "form-group">
		    <input type = "password" name = "Npassword" id = "password" placeholder = "Password" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required onkeyup = 'checkPassword();'>
		    </div>
		    <div class = "form-group">
		    <input type = "password" name = "Nconfirm" id = "confirm" placeholder = "Confirm Password" required onkeyup = 'checkConfirmPassword();'>
		    </div>
		    <div class = "form-group">
		    <input type = "email" name = "Nemail" id = "email" placeholder = "Email" multiple required>
		    </div>
		    <div class = "form-group">
		    <input type = "submit" value = "Submit" >
		    </div>
		    
		    <label id = "wrongPassword">both password doesn't match</label>
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

