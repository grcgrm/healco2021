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
include 'db_conn.php';

session_start();


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

<?php 

if(isset($_POST['submit'])){


$apicode = "TR-HEALC117601_CKYTN";
$apipw = "5n[)6l#[93";


$ver = $_POST['verify'];

$sql = mysqli_query($conn, "SELECT * FROM temp_patient WHERE otp='$ver' ");

if(mysqli_num_rows($sql) > 0) {
    //Meaning may nakuhang data na similar dun based sa condition sa query

    $row = mysqli_fetch_assoc($sql);

    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    $address = $row['address'];
    $age = $row['age'];
    $otp = $row['otp'];

    
        $sqlins = mysqli_query($conn, "INSERT INTO `patient`(`name`,`username`,`email`,`phone`,`password`,`address`,`age`)VALUES('$name','$username','$email','$phone','$password','$address','$age')" );
    
        $text = "Dear" . $name . ", you are successfully verified." ;

        $sms = itexmo($phone,$text,$apicode,$apipw);
        if ($sms == ""){
        echo "iTexMo: No response from server!!!
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
        Please CONTACT US for help. ";	
        }else if ($sms == 0){
        echo "Message Sent!";
        }
        else{	
        echo "Error Num ". $sms . " was encountered!";
        }
    
        $sqldel = mysqli_query($conn, "DELETE FROM `temp_patient` WHERE `otp`='$otp' ");

        $ai = mysqli_query($conn, "ALTER TABLE `temp_patient` AUTO_INCREMENT = 1");

        echo "<script language = javascript>
            Swal.fire(
                'Success!',
                'Successfully Registered.',
                'success'
            ).then((result) => {
                
                window.location.href = 'index1.php';
              });
        </script>";

        unset($_SESSION['SendOTP']);
    
}else{
    //Wala, mismatch ng OTP

    echo "<script language = javascript>
            Swal.fire(
                'Error!',
                'OTP submitted is mismatched.',
                'error'
            ).then((result) => {
                
                window.location.href = 'otp2.php';
              });
        </script>";
}
}

else if(isset($_POST['resend'])){

    
    $apicode = "TR-HEALC117601_CKYTN";
    $apipw = "5n[)6l#[93";
   

    $reotp = $_POST['resend'];

    $otp = rand(100000, 999999);

    $sql = mysqli_query($conn, "SELECT * FROM `temp` WHERE `otp`='$reotp' ");

    $row = mysqli_fetch_assoc($sql);


    $name = $row['name'];
    // $phone = $row['phone'];

    $sql2 = mysqli_query($conn, "UPDATE `temp` SET `otp`='$otp' WHERE `otp`='$reotp' ");

    if($sql2){
        $text = "Dear " . $name . ", Please verify your new OTP, " . $otp . ".";

            $sms = itexmo("09551405749",$text,$apicode,$apipw);
            if ($sms == ""){
            echo "iTexMo: No response from server!!!
            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
            Please CONTACT US for help. ";	
            }else if ($sms == 0){
            echo "Message Sent!";
            }
            else{	
            echo "Error Num ". $sms . " was encountered!";
            }

             echo "<script language = javascript>
             Swal.fire(
                 'Success!',
                'OTP succesfully sent. Kindly check your cellphone.',
                'success'
            ).then((result) => {
                
               window.location.href = 'index1.php';
               });
         </script>";
              
    } else {
         echo "<script language = javascript>
            Swal.fire(
                'Error!',
                'OTP resend encountered an error.',
                 'error'
            ).then((result) => {
                
                 window.location.href = 'otp2.php';
               });
         </script>";
    }

    
}
?>

<form class="border shadow p-4 rounded-20"
      	      action="" 
      	      method="post" 
      	      style="width: 400px; margin:auto; margin-top: 130px">

				
<a href="logintype.php" class="btn btn-sm" style="width: 65px; height: 25px; font-size: 12px; padding-top:2px; margin-left: -15px; margin-top: -20px; opacity: .5">BACK</a>

<h1 class="text-center p-3">OTP</h1>


<div class="mb-3">
<label for="verify" 
   class="form-label">OTP</label>
<input type="text" 
   class="form-control" 
   name="verify" 
   id="verify" placeholder="Input OTP" required>
</div>


<div class="d-grid gap-2 col-6 mx-auto mb-3" >
			<button name="submit" name="verify"
		  class="btn btn-primary">Verify</button>


<div class="text-center .d-flex">
    </div>

 

</form>
     <form action="" method="POST">
    <button name="resend" value="<?php echo $_SESSION['SendOTP'] ?>" class="btn btn-primary">Resend</button>
    </form>
	</div>

    
	  
</body>
</html>