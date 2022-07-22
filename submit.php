
<!DOCTYPE html>
<html>
<head>
	<title>HealCo | Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="signup.css"/>
</head>

<body>
<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>


<?php 
include "db_conn.php";
error_reporting(0);

if(isset($_POST['submit']))
{
    


	$file= $_FILES["bir"]["name"];
    $tempname = $_FILES["bir"]["tmp_name"];
	$folder = "uploads/".$file;
	
	$file1= $_FILES["mayor"]["name"];
    $tempname1 = $_FILES["mayor"]["tmp_name"];
	$folder = "uploads/".$file1; 
	
	$file2= $_FILES["license"]["name"];
    $tempname2 = $_FILES["license"]["tmp_name"];
	$folder = "uploads/".$file2;

	$file3= $_FILES["operate"]["name"];
    $tempname3 = $_FILES["operate"]["tmp_name"];
	$folder = "uploads/".$file3;
	
	$file4= $_FILES["doh"]["name"];
    $tempname4 = $_FILES["doh"]["tmp_name"]; 
	$folder = "uploads/".$file4;

	$file5= $_FILES["bfp"]["name"];
    $tempname5 = $_FILES["bfp"]["tmp_name"];
	$folder = "uploads/".$file5;
	
	$file6= $_FILES["build"]["name"];
    $tempname6 = $_FILES["build"]["tmp_name"];
	$folder = "uploads/".$file6; 
	
	$file7= $_FILES["valid"]["name"];
    $tempname7 = $_FILES["valid"]["tmp_name"];
	$folder = "uploads/".$file7;
	
	$code = $_GET['code'];
	

	$sql = "UPDATE `users` SET bir = '$file', mayor = '$file1', license = '$file2', operate = '$file3', 
			doh = '$file4', bfp = '$file5', build = '$file6', valid = '$file7' WHERE username = '".$code."'";
	
	
	$result = mysqli_query($conn,$sql);
	
	
	if($result)
	{

		move_uploaded_file($tempname, $folder);
		move_uploaded_file($tempname1, $folder);
		move_uploaded_file($tempname2, $folder);
		move_uploaded_file($tempname3, $folder);
		move_uploaded_file($tempname4, $folder);
		move_uploaded_file($tempname5, $folder);
		move_uploaded_file($tempname6, $folder);
		move_uploaded_file($tempname7, $folder);
	
								
				echo "<script language = javascript>
						Swal.fire(
							'Your application have been submitted!',
							'Please wait for the confirmation of your account',
							'success'
							).then((result) => {  window.location.href = 'home.php';});
					  </script>";
	} else{
		echo "<script language = javascript>
						Swal.fire(
							'Oops!',
							'Error',
							'error'
							);
					  </script>";
	}
	

		
		       
  }
?>



<form class=" center border shadow p-4 rounded-20 mb-0" 
      	      method="post" enctype="multipart/form-data"
      	      style="width: 600px; margin: 0 auto; margin-top: 20px;">

<h1 class="form-label text-lg-center" style="color: rgb(22, 135, 163); font-weight:500">CLINIC REQUIREMENTS </h3>

                <label for="" style="font-size: 15px;"> Please submit all the following documents in image file. Make sure to get a clear and readable picture.</label>
<br> <br>

<table>
	<tr>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> BIR FORM</label>
		<input required type="file" class="form-control mb-3" name="bir" id="image" accept="image/jpg, image/jpeg">
		</td>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> MAYOR'S PERMIT</label>
		<input required type="file" class="form-control mb-3" name="mayor" id="image" accept="image/jpg, image/jpeg">
		</td>
	</tr>

	<tr>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> DOCTOR'S LICENSE</label>
<input required type="file" class="form-control mb-3" name="license" id="image" accept="image/jpg, image/jpeg">
		</td>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> LICENSE TO OPERATE</label>
<input required type="file" class="form-control mb-3" name="operate" id="image" accept="image/jpg, image/jpeg">
		</td>
	</tr>

	<tr>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> DOH FORM</label>
<input required type="file" class="form-control mb-3" name="doh" id="image" accept="image/jpg, image/jpeg">
		</td>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> CERTIFICATION OF BFP SAFETY</label>
<input required type="file" class="form-control mb-3" name="bfp" id="image" accept="image/jpg, image/jpeg">
		</td>
		</tr>

		<tr>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> BUILDING'S PERMIT</label>
<input required type="file" class="form-control mb-3" name="build" id="image" accept="image/jpg, image/jpeg">
		</td>
		<td>
		<label class="ms-1 mb-1" style="font-size: 16px; font-weight: 500"> VALID ID</label>
<input required type="file" class="form-control mb-3" name="valid" id="image" accept="image/jpg, image/jpeg">
		</td>
		</tr>
</table>



<p5 class="font-italic" style="font-size: 12px;">Note: These are all the documents required to check if the clinic is fully registered and fulfills the requirement of the government.</p>


<div class="col-md-12 text-center">
	        <div class="button">
	            <input type="submit" name="submit" id="submit" value="SUBMIT" class="wpcf7-form-control wpcf7-submit">
	        </div>
	    </div>
			
		<style>
			.button .wpcf7-submit {
    background-image: linear-gradient(to right,#ff00cc 0%,#333399 51%,#ff00cc 100%);
    background-size: 200% auto;
    color: #ffffff !important;
    border-radius: 25px;
    font-weight: 400;
    font-size: 14px;
    text-transform: uppercase;
    border: none !important;
    transition: 0.7s all;
    -webkit-transition: 0.7s all;
    margin-top: 14px;
    display: inline-block;
    width: 192px;
    height: 40px;
}
.button .wpcf7-submit:hover{
    background-position: right center;

}

		</style>

</form>

</body>
</html>
