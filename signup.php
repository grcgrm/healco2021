<?php 
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
}
//##########################################################################


?>

<!DOCTYPE html>
<html>
<head>
<title>HealCo | Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="signup.css"/>

    <script>
 function disableSubmit() {
  document.getElementById("submit").disabled = true;
 }

  function activateButton(element) {

      if(element.checked) {
        document.getElementById("submit").disabled = false;
       }
       else  {
        document.getElementById("submit").disabled = true;
      }

  }
</script>



<body onload="disableSubmit()">
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      <script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>



</head>
<?php
include 'db_conn.php';
error_reporting(0);

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $address = $_POST['address'];
    $age = $_POST['age'];

    if ($password == $cpassword) {

		$sql = "SELECT * FROM patient WHERE username='$username'";
		$result = mysqli_query($conn, $sql);

        
		if (!$result->num_rows > 0) {

                // $apicode = "TR-GRACE920713_BR92M";
                // $apipw = "xs@fxi%b&n";

                $apicode = "ST-HEALC117601_YNVGC";
                $apipw = "vjs4]3mu81";

                $otp = mt_rand(1111,9999);

                $text = "Your OTP CODE from HealCo is " . $otp . ".";

                        $result = itexmo($phone,$text,$apicode, $apipw);
                            if ($result == ""){
                                echo "<script language = javascript>
                                    Swal.fire(
                                        'Sorry!',
                                        'No response from server. Please try again.',
                                        'error'
                                    )
                                </script>";
                                }else if ($result == 0){

                                    $sql = "INSERT INTO temp (name, username, email, password, phone, address, age, otp)
					            VALUES ('$name','$username', '$email', '$password', '$phone', '$address', '$age', '$otp')";
                                $result = mysqli_query($conn, $sql);

                                
                                    echo "<script language = javascript>
                                    Swal.fire(
                                        'Success',
                                        'OTP Code is sent to $phone',
                                        'success'
                                      ).then((result) => {
                            
                                        window.location.href = 'otp.php?code=$username';
                                      });
                                </script>";
                                
                                
                                }
                                else{	
                                    echo "<script language = javascript>
                                    Swal.fire(
                                        'Sorry!',
                                        'Error Number #'. $result . 'was encountered! Contact our customer support.',
                                        'error'
                                    ).then((result) => {
                            
                                        window.location.href = 'home.php#contact';
                                      });
                                </script>";
                                
                                }
						
                            
                            
     } else {
			echo "<script language = javascript>
                Swal.fire(
                    'Oops!',
                    'Username/Email Already Exist. Please try again.',
                    'error'
                  )
            </script>";
		
                }
    }else {
		echo "<script language = javascript>
                Swal.fire(
                    'Try Again',
                    'Password DO NOT Matched!',
                    'error'
                  )
            </script>";
                }	
            
            }

?>

      	<form class="border shadow p-4 rounded-20 mb-0"

      	      method="post" 
      	      style="width: 600px;">

				<a href="usertype.php" class="btn" style="width: 65px; height: 25px; font-size: 12px; padding-top:4px; opacity: .7">BACK</a>

      	      <h1 class="text-center p-2">SIGN UP AS PATIENT</h1>

 
            <table>
                    <tr>

                    <td>
                            <label for="name" 
                            class="form-label">Full Name</label>
                    </td>

                    <td>
                            <label for="username" 
                            class="form-label">Username</label>
                    </td>
                    
                    </tr>

                    <tr>

                    <td>
                        <input type="text"
                        class="form-control" 
                        name="name" required
                        id="name"
                        placeholder="First Name M.I. Last Name"
                        value="<?php echo $name?>"
                        >   
                    </td>

                    <td>
                        <input type="text" 
                        class="form-control" 
                        name="username" required
                        id="username"
                        placeholder="Minimum 0f 6 characters"
                        value="<?php echo $username?>"
                        >
                    </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="email" 
                            class="form-label">Email</label>
                        </td>

                        <td>
                            <label for="phone" 
                            class="form-label">Phone Number</label>
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <input type="email" 
                            class="form-control" 
                            name="email" required
                            id="email"
                            value="<?php echo $email?>"
                            >
                        </td>

                        <td>
                            <input type="phone" 
                            class="form-control" 
                            name="phone" required
                            id="phone"
                            placeholder="+63 - "
                            value="<?php echo $phone?>"
                            >
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="address" 
                            class="form-label">Address</label>
                        </td>
                        
                        <td>
                            <label for="age" 
                            class="form-label">Age</label>
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <input type="address" 
                            class="form-control" 
                            name="address" required
                            id="address"
                            placeholder="House Number, Street Name, Barangay, City/Municipality, Province"
                            value="<?php echo $address?>"
                            >
                        </td>

                        <td>
                            <input type="text" 
                            class="form-control" 
                            name="age" required
                            id="age"
                            value="<?php echo $age?>"
                            >
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="password" 
                            class="form-label">Password</label>
                        </td>

                        <td>
                            <label for="cpassword" 
                            class="form-label">Confirm Password</label>
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <input type="password" 
                            class="form-control" 
                            title="Password must contain: Minimum 8 characters atleast 1 letter and 1 number"
                            required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                            name="password" required
                            id="password"
                            placeholder="Minimum 8 characters(contains letter and number)"
                            value="<?php echo $_POST['password']?>"
                            > 
                        </td>

                        <td>
                            <input type="password" 
                            class="form-control" 
                            name="cpassword" required
                            id="cpassword"
                            value="<?php echo $_POST['cpassword']?>"
                            > 
                        </td>

                    </tr>


            </table>
            
            


		 
			
            <div class="form-check mt-3">
                <input class="form-check-input" name="checkboxID" type="checkbox" value="" id="checkboxID" onchange="activateButton(this)">
                    <label class="form-check-label" for="flexCheckDefault">
                    <p>I agree to the HealCo
                    <a href="terms.php">Terms & Condition and Policy</a>
                    </label>
            </div>
           
            <div class="d-grid gap-2 col-6 mx-auto mb-3" >
			<button type="submit" name="submit" id="submit"
		  class="btn btn-primary">SIGN UP</button>
			</div>
			

			<div class="text-center">
			<a href="index1.php" class="ca">Already have an account? Login Here</a>
			</div>
      </div>
		  
		</form>

        
        
</body>
</html>
