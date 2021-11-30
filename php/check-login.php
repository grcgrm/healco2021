
<?php  
session_start();
include "../db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

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
        
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		
        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password) {

					$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND status = 1";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) === 1) {
						$row = mysqli_fetch_assoc($result);
						$_SESSION['cname'] = $row['cname'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['role'] = $row['role'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['city'] = $row['city'];
						$_SESSION['phone'] = $row['phone'];

						header("Location: ../profile1.php");
						die();
					} 
					else{
						echo "<script>
							alert('Your profile is still being processed. Please wait for approval.');
							window.location.href='../index.php';
							</script>";
					}
				}
			
		}
		else {
			echo "<script>
				alert('You entered incorrect username or password.');
				window.location.href='../index.php';
				</script>";
        	}

		
	
}else {
	header("Location: ../index.php");
}
?>
