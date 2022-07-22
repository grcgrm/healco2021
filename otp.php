<?php 
include 'db_conn.php';
error_reporting();

?>
<!DOCTYPE html>
<html>
<head>
<title>HealCo | Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="login.css"/>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>

<?php if(isset($_POST['submit'])){



$otp = $_POST['otp'];

$sql = "SELECT * FROM temp WHERE otp=$otp";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if($count > 0) {

    $row = mysqli_fetch_assoc($result);
  

    $first = $row['first'];
    $middle = $row['middle']; 
    $last = $row['last'];
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    $address = $row['address'];
    $birth = $row['birthdate'];
    $sex = $row['gender'];
    $status = $row['status'];


    
            
    $sql = "INSERT INTO patient (last, first, middle, username, email, password, phone, address, birth, sex, status)
		VALUES ('$last', '$first', '$middle', '$username', '$email', '$password', '$phone', '$address', '$birth', '$sex', '$status')";
         $result = mysqli_query($conn, $sql);

            if($result)
            {
                echo "<script language = javascript>
                Swal.fire(
                    'Thank you!',
                    'Successfully Registered. Please log in to your account',
                    'success'
                ).then((result) => {
                    
                    window.location.href = 'index1.php';
                  });
            </script>";

            $sqldel = mysqli_query($conn, "DELETE FROM `temp` WHERE `otp`='$otp' ");

            $ai = mysqli_query($conn, "ALTER TABLE `temp` AUTO_INCREMENT = 1");
            } else {
                echo "error";
            }
            
            
                    
				
                
                    

       
    
}else{

    echo "<script language = javascript>
            Swal.fire(
                'Error!',
                'OTP submitted is wrong.',
                'error'
            ).then((result) => {
                
                window.location.href = 'otp.php?code=$username';
              });
        </script>";

}
}

?>


<form class="border shadow p-4 rounded-20"
      	      action="" 
      	      method="post" 
      	      style="width: 425px; margin:auto; margin-top: 160px">

				
<a href="logintype.php" class="btn btn-sm" style="width: 65px; height: 25px; font-size: 12px; padding-top:2px; margin-left: -15px; margin-top: -20px; opacity: .9">BACK</a>

<h1 class="text-center p-3 mb-0" style="font-size: 28px;">ACCOUNT VERIFICATION</h1>

<?php 

        if(isset($_GET['code']))
        {
            $code = $_GET['code'];
            $list = "SELECT * FROM temp WHERE username='".$code."'";
        $res = mysqli_query($conn, $list);
        $row=mysqli_fetch_assoc($res);
        }

?>

                <p class="text-muted text-center mb-3" style="font-size: 14px; margin-top: -10px">4-digit code has been sent to <?php echo $row['phone'] ?></p>




<div class="mb-2">
<label for="otp" 
   class="form-label">OTP CODE</label>
<input type="text" 
   class="form-control" 
   name="otp" 
   id="otp" required>
</div>

<p class="text-muted text-justify mt-0" style="font-size: 12px;">Please enter the one time password to verify your account</p>




<div class="d-grid gap-2 col-6 mx-auto mb-1 mt-4" >
			<button type="submit" name="submit"
		  class="btn btn-primary">Verify Code</button>
			</div>
            

	 </form>
	  
</body>
</html>
