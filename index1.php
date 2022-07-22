<?php 
   session_start();
   include ('db_conn.php');
   error_reporting(0);
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
	 ?>
<!DOCTYPE html>
<html>
<head>
<title>HealCo | Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="login.css"/>
</head>
<body>
<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>

<?php
if (isset($_POST['submit'])) {

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	


		// Hashing the password
		$password = md5($password);
        
        $sql = "SELECT *FROM patient WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		
        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password) {
        		$_SESSION['name'] = $row['name'];
        		$_SESSION['id'] = $row['id'];
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['phone'] = $row['phone'];
				$_SESSION['birth'] = $row['birth'];
				$_SESSION['age'] = $row['age'];
				$_SESSION['sex'] = $row['sex'];
				$_SESSION['disease'] =  serialize($arr);
				$_SESSION['status'] = $row['status'];
				$_SESSION['c_illness'] = $row['c_illness'];
				$_SESSION['m_problems'] = $row['m_problems'];
				$_SESSION['medication'] = $row['medication'];
				$_SESSION['reason'] = $row['reason'];
				$_SESSION['father'] = $row['father'];
				$_SESSION['f_age'] = $row['f_age'];
				$_SESSION['f_cause'] = $row['f_cause'];
				$_SESSION['mother'] = $row['mother'];
				$_SESSION['m_age'] = $row['m_age'];
				$_SESSION['m_cause'] = $row['m_cause'];
				$_SESSION['disease'] = $row['disease'];
				$_SESSION['other'] = $row['other'];
				$_SESSION['drug'] = $row['drug'];
				$_SESSION['reaction'] = $row['reaction'];
				$_SESSION['cname'] = $row['cname'];
				$_SESSION['date_created'] = $row['date_created'];
				

            header("Location: profile.php");
            die();
               
				}
				
					
		}else {
         echo "<script language = javascript>
         Swal.fire(
            'Oops!',
            'You entered incorrect username/password',
            'error'
            ).then((result) => {
                  
            window.location.href = 'index1.php';
            });
         </script>";
        	}
        

	}
	


?>

<form class="border shadow p-4 rounded-20"
      	      action="" 
      	      method="post" 
      	      style="width: 400px; margin:auto; margin-top: 130px">

				
<a href="logintype.php" class="btn btn-sm" style="width: 65px; height: 25px; font-size: 12px; padding-top:2px; margin-left: -15px; margin-top: -20px; opacity: .9">BACK</a>

<h1 class="text-center p-3">LOGIN AS PATIENT</h1>


<div class="mb-3">
<label for="username" 
   class="form-label">Username</label>
<input type="text" 
   class="form-control" 
   name="username" 
   id="username" required>
</div>

<div class="mb-4">
<label for="password" 
   class="form-label">Password</label>
<input type="password" 
   name="password" 
   class="form-control" 
   id="password" required>
</div>



<div class="d-grid gap-2 col-6 mx-auto mb-3" >
			<button type="submit" name="submit"
		  class="btn btn-primary">LOGIN</button>
			</div>

<div class="text-center .d-flex">
<a href="usertype.php" class="ca">Create an Account? Sign Up Here</a>
    </div>

 

	 </form>
	  
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>