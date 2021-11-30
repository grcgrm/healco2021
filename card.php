<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>HealCo | Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">

</head>
<body>


<?php 
include "db_conn.php";
error_reporting(0);

if(isset($_POST['submit']))
{
    
  $card_num = $_POST['card_num'];
  $card_name = $_POST['card_name'];
  $card_expi = $_POST['card_expi'];
  $card_cvv = $_POST['card_cvv'];
	$code = $_GET['code'];
	

	$sql = "UPDATE `users` SET card_num = '$card_num', card_name = '$card_name', card_expi = '$card_expi', card_cvv = '$card_cvv'  WHERE username = '".$code."'";
  $result = mysqli_query($conn,$sql);
	if($result)
	{
					
  header("Location: submit.php?code=".$_GET['code']."");			
  }

		
		       
  }
?>




<form method="POST" class="p-4 border-shadow rounded-20" style="width: 500px; margin: auto; margin-top: 45px">
<div class="form-group">
    <h3 class="text-center" style="font-size: 24px; color: rgb(25, 135, 180); font-weight: 500">Payment Information</h3>
    
    <img src="img/visa.png" style="margin-top:-7px; margin-left: 130px;">
    <img src="img/1156750_finance_mastercard_payment_icon.png" style="margin-top:-7px; margin-left: 50px;">
     <br>
    
    <label class="ms-1 mt-3">Card Number</label>
      <div class="col-md-12">
        <input class="form-control" id="cc" name="card_num" aria-describedby="help" placeholder="----  ----  ----  ----" onkeypress="return checkDigit(event)">
        <small id="help" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>

    <label class="ms-1 mt-3">Card Holder</label>
      <div class="col-md-12">
        <input class="form-control" type="text" name="card_name" id="" aria-describedby="help">
        <small id="help" class="form-text text-muted">Enter the name written on the card.</small>
      </div>

      <label class="ms-1 mt-3">Expiry Date/Valid Thru</label>
      <div class="col-md-12" id="datepicker">
        <input class="form-control" type="month" name="card_expi" id="datepicker" aria-describedby="help">
        <small id="help" class="form-text text-muted">Expiry date is written with this format MM/YY.</small>
      </div>

      <label class="ms-1 mt-3">CVV</label>
      <div class="col-md-12">
        <input class="form-control" type="text" name="card_cvv" aria-describedby="help" onkeypress="return isNumberKey(event)" maxlength="4">
        <small id="help" class="form-text text-muted">3 or 4 digits usually found on the back of the card.</small>
      </div>
  </div>

  <div class="d-grid gap-2 col-6 mx-auto mt-3" >
            <button class="btn btn-primary" name="submit" type="submit" id="submit">Pay Php 700.00</button>
                </div>
</form>

<script src="card.js"></script>
</body>
</html>