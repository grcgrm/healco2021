<!DOCTYPE html>
<html>
<head>
	<title>Healco | Admin</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/waveee.png">
	<img src="img/logo.png.ico" style="margin-bottom: -400px; margin-left: 150px;; margin-top: 150px">
	<div class="container">
		<div class="img">
			
		</div>
		<div class="login-content">
			<form action="" method="POST">
				
				<h2 class="title">HealCo Admin</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>

           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	
            	<input type="submit" name="submit" class="btn" value="Login">
            </form>
        </div>
    </div>

<?php

if(isset($_POST['submit']))
{
	$admin = 'admin';
	$adminpw = 'healco2021';
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($admin == $username AND $adminpw == $password)
	{
		header("Location: dashboard.php");
	}
}
?>

    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
