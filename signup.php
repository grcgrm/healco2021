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
    $first = $_POST['first'];
    $middle = $_POST['middle']; 
    $last = $_POST['last'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $address = $_POST['address'] . ' - ' . $_POST['city'];


    

    $birthdate = $_POST['birthdate'];
    $sex = $_POST['sex'];
    $status = $_POST['status'];

    

    if ($password == $cpassword) {

		$sql = "SELECT * FROM patient WHERE username='$username'";
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

                                    $sql = "INSERT INTO temp (last, first, middle, username, email, password, phone, address, age, birthdate, gender, status, otp)
					            VALUES ('$last', '$first', '$middle', '$username', '$email', '$password', '$phone', '$address', '$age', '$birthdate', '$sex', '$status', '$otp')";
                                $result = mysqli_query($conn, $sql);

                                if($result){
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
      	      style="width: 680px;">

				<a href="usertype.php" class="btn" style="width: 65px; height: 25px; font-size: 12px; padding-top:4px; opacity: .7">BACK</a>

      	      <h1 class="text-center p-2">SIGN UP AS PATIENT</h1>

 
            <table>
                    <tr>

                    <td>
                            <label for="name" 
                            class="form-label">Last Name</label>
                    </td>

                    <td>
                            <label for="username" 
                            class="form-label">First Name</label>
                    </td>

                    <td>
                            <label for="username" 
                            class="form-label">Middle Name</label>
                    </td>
                    
                    </tr>

                    <tr>

                    <td>
                        <input type="text"
                        class="form-control" 
                        name="last" required
                        id="last"
                        value="<?php echo $name?>"
                        >   
                    </td>

                    <td>
                        <input type="text"
                        class="form-control" 
                        name="first" required
                        id="first"
                        value="<?php echo $name?>"
                        >   
                    </td>

                    <td>
                        <input type="text"
                        class="form-control" 
                        name="middle" required
                        id="middle"
                        value="<?php echo $name?>"
                        >   
                    </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="username" 
                            class="form-label mt-2">Username</label>
                        </td>

                        <td>
                            <label for="email" 
                            class="form-label mt-2">Email</label>
                        </td>

                        <td>
                            <label for="phone" 
                            class="form-label mt-2">Phone Number</label>
                        </td>

                    </tr>

                    <tr>
                         <td>
                            <input type="text" 
                            class="form-control" 
                            name="username" required
                            id="username"
                            placeholder="Minimum of 6 characters"
                            value="<?php echo $username?>"
                            >
                        </td>

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
                            placeholder=""
                            value="<?php echo $phone?>"
                            >
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="address" 
                            class="form-label mt-2">Address</label>
                        </td>
                    </tr>  
                   

                    <tr>


                        <td>
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

                        <td colspan="2">
                        <input type="text" class="form-control" name="address" placeholder="Complete Address">
                           
                        </td>

                    </tr>
                    <tr>


                        <td>
                            <label for="birthday" 
                            class="form-label mt-2">Birthdate</label>
                        </td>

                        <td>
                            <label for="gender" 
                            class="form-label mt-2">Gender</label>
                        </td>

                    </tr>
                    <tr>


                        <td>
                            <input class="form-control" type="date" name="birthdate">
                        </td>

                        <td>
                        <select class="form-select"
                            name="sex" id="sex"  value="<?php echo $sex ?>">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                        
                    </select>
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <label for="status" 
                            class="form-label mt-2">Marital Status</label>
                        </td>

                        <td>
                            <label for="password" 
                            class="form-label mt-2">Password</label>
                        </td>

                        <td>
                            <label for="cpassword" 
                            class="form-label mt-2">Confirm Password</label>
                        </td>

                    </tr>

                    <tr>

                        <td>
                        <select class="form-select form-select-sm "
                                name="status" id="status"  value="<?php echo $status?>">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                            
                        </select>

                        </td>

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
            
            


		 
			
            <div class="form-check mt-3 text-center">
                <input class="form-check-input me-0" style="margin-left: 65px;" name="checkboxID" type="checkbox" value="" id="checkboxID" onchange="activateButton(this)">
                    <label class="form-check-label ms-0 mb-3" for="flexCheckDefault">
                    I agree to the HealCo
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
