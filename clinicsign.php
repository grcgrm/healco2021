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



</head>
<body onload="disableSubmit()">
<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>

      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">


      <?php

include 'db_conn.php';
error_reporting(0);

if(isset($_POST['submit']))
{
    $id = $_GET['id'];
    $status = $_POST['status'];
    $cname = $_POST['cname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $address = $_POST['address'];


    if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email' AND username='$username'";
		$result = mysqli_query($conn, $sql);

        
		if (!$result->num_rows > 0) {


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

                                    $sql = "INSERT INTO temp (cname, username, email, password, phone, address, age, otp, city)
					            VALUES ('$cname','$username', '$email', '$password', '$phone', '$address', '$age', '$otp' , '$city')";
                                $result = mysqli_query($conn, $sql);

                                
                                    echo "<script language = javascript>
                                    Swal.fire(
                                        'Success',
                                        'OTP Code is sent to $phone',
                                        'success'
                                      ).then((result) => {
                            
                                        window.location.href = 'otp1.php?code=$username';
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
                            
                                        window.location.href = 'clinicsign.php';
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
				<a href="usertype.php" class="btn" style="width: 65px; height: 25px; font-size: 12px; padding-top:3px; opacity: .9;">BACK</a>

      	      <h1 class="text-center p-2">SIGN UP AS CLINIC</h1>

 
<table>

<tr>

<td>
<div class="mt-1 mb-0 ">
                <label for="name" 
                class="form-label">Clinic Name</label>
                <input type="text"
                    class="form-control" 
                    name="cname" required
                    id="cname"
                    value="<?php echo $name?>"
                    >   
		    </div>
</td>



<td>
<div class="mt-1 mb-0 ms-4">
                <label for="username" 
                class="form-label">Username</label>
                <input type="text" 
                    class="form-control" 
                    name="username" required
                    id="username"
                    value="<?php echo $username?>"
                    >
		    </div>
</td>


</tr>

<tr>

<td>
<div class="mt-1 mb-0">
                <label for="email" 
                class="form-label">Email</label>
                <input type="email" 
                    class="form-control" 
                    name="email" required
                    id="email"
                    value="<?php echo $email?>"
                    >
		    </div>
</td>

<td>
<div class="mt-1 mb-0 ms-4">
                <label  
                class="form-label">Phone Number</label>
                <input 
                    class="phone form-control" 
                    name="phone" required
                    id="phone"
                    placeholder=""
                    type="phone"
                    value="<?php echo $phone?>"
                >
		    </div>
</td>


</tr>

<tr>

<td>
<div class="mt-1 mb-0">
		    <label class="form-label">Select City/Municipality:</label>
		  </div>
		  <select class="form-select mt-0 mb-0"
		          name="city" id="city"  value="<?php echo $city?>"
		          >
			  <option value="Agoncillo">Agoncillo</option>
			  <option value="Alitagtag">Alitagtag</option>
			  <option value="Balayan ">Balayan </option>
              <option value="Balete">Balete</option>
              <option value="Batangas City">Batangas City</option>
              <option value="Bauan ">Bauan </option>
              <option value="Calaca">Calaca </option>
              <option value="Calatagan">Calatagan</option>
              <option value="Cuenca ">Cuenca </option>
              <option value="Fernando Airbase ">Fernando Airbase </option>
              <option value="Ibaan">Ibaan</option>
              <option value="Laurel">Laurel</option>
              <option value="Lemery">Lemery</option>
              <option value="Lian">Lian</option>
              <option value="Lipa City">Lipa City</option>
              <option value="Lobo">Lobo</option>
              <option value="Mabini">Mabini </option>
              <option value="Malvar">Malvar </option>
              <option value="Mataas na Kahoy">Mataas na Kahoy</option>
              <option value="Nasugbu">Nasugbu </option>
              <option value="Padre Garcia">Padre Garcia</option>
              <option value="Rosario">Rosario</option>
              <option value="San Jose ">San Jose </option>
              <option value="San Juan">San Juan</option>
              <option value="San Luis">San Luis</option>
              <option value="San Nicolas ">San Nicolas </option>
              <option value="San Pascual">San Pascual</option>
              <option value="Sta. Teresita">Sta. Teresita</option>
              <option value="Sto. Tomas">Sto. Tomas</option>
              <option value="Taal">Taal</option>
              <option value="Talisay">Talisay</option>
              <option value="Tanauan">Tanauan</option>
              <option value="Taysan">Taysan</option>
              <option value="Tingloy">Tingloy</option>
              <option value="Uy">Uy</option>


		  </select>
</td>

<td>
<div class="mt-1 mb-0 ms-4">
                <label for="address" 
                class="form-label">Address</label>
                <input type="address" 
                    class="form-control" 
                    name="address" required
                    id="address"
                    title="House Number, Street Name, Barangay, City/Municipality, Province"
                    placeholder="House Number, Street Name, Barangay, City/Municipality, Province"
                    value="<?php echo $address?>"
                >
		    </div>
</td>

</tr>

<tr>

<td>
<div class="mt-1 mb-0">
                <label for="password" 
                class="form-label">Password</label>
                <input type="password" 
                    class="form-control"
                    title="Password must contain: Minimum of 8 characters atleast 1 letter and 1 number"
                    required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                    name="password" required
                    id="password"
                    placeholder="Minimum 8 characters(contains letter and number)"
                    value="<?php echo $_POST['password']?>"
                > 
		    </div>
            
           
</td>

<td>
<div class="mt-1 mb-0 ms-4">
                <label for="cpassword" 
                class="form-label">Confirm Password</label>
                <input type="password" 
                    class="form-control" 
                    name="cpassword" required
                    id="cpassword"
                    value="<?php echo $_POST['cpassword']?>"
                    > 
		    </div>
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
            <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="d-grid gap-2 col-6 mx-auto mb-3" >
            <button class="btn btn-primary" name="submit" type="submit" id="submit">NEXT</button>
                </div>
                
                <div class="text-center">
                <a href="index.php" class="ca">Already have an account? Login Here</a>
                </div>
      </div>
     
		  
		</form>
     
        
                
</body>
</html>