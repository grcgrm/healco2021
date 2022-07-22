
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
				

        		header("Location: ../profile.php");
				die();
               
				}
				
			
		
			
        	
			
					
		}else {
        		header("Location: ../index1.php?error=Incorect User name or password");
        	}
        

	}
	
	
else {
	header("Location: ../index1.php");
}
?>
