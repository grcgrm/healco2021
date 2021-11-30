<?php
		  include 'db_conn.php';
		  error_reporting(0);
		  

if (isset($_POST['role'])) {


$role = $_POST['role'] ;


$sql = "UPDATE users SET role = $role WHERE id=$id";
if($role == 'Clinic'){
	
    header("Location: clinicsign.php"); // This line triggers a redirect if the user_type is clinic
} else {
	
    header("Location: signup.php"); // This line triggers for other user_types
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>HealCo | Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="login.css"/>
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
	  
      	<form class="border shadow p-4 rounded-20 mb-0"
		  
				method="POST"
      	      style="width: 400px;">

				<div class="text-left">
				<a class="home ps-1 pe-1" href="home.php" role="button">Back to Home</a>
			</div>

      	      <h1 class="text-center p-2">SIGN UP</h1>

		  <div class="mt-1 mb-0">
		    <label class="form-label">Select User Type:</label>
		  </div>
		  <select class="form-select mb-3"
		          name="role" 
		          aria-label="Default select example">
			  <option selected value="Patient">Patient</option>
			  <option value="Clinic">Clinic</option>
			  
		  </select>

			<div class="d-grid gap-2 col-6 mx-auto mb-3" >
			<button type="submit" name="submit"
		  class="btn btn-primary">NEXT</button>
			</div>
				
			<div class="text-center">
			<a href="logintype.php" class="ca">Already have an account? Login Here</a>
			</div>
      </div>
		  
	  
		</form>

        
</body>
</html>
